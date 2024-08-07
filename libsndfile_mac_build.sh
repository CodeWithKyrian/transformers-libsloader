#!/bin/bash

set -e

OGGVERSION=1.3.5
VORBISVERSION=1.3.7
FLACVERSION=1.4.3
OPUSVERSION=1.4
MPG123VERSION=1.32.3
LAMEVERSION=3.100
SNDFILE_VERSION=1.2.2

JOBS=8
SNDFILENAME=libsndfile-$SNDFILE_VERSION
OGG_INCDIR="$(pwd)/libogg-$OGGVERSION/include"
OGG_LIBDIR="$(pwd)/libogg-$OGGVERSION/src/.libs"

if [ "$1" = "arm64" ]; then
    echo "Cross compiling for Darwin arm64.."
    export MACOSX_DEPLOYMENT_TARGET=11.0
    BUILD_HOST="--host=aarch64-apple-darwin --target=arm64-apple-macos11"
    EXTRA_CFLAGS="-arch arm64 -target arm64-apple-macos11"
    CMAKE_ARCHITECTURE="arm64"
else
    echo "Building for Darwin $(uname -m).."
    export MACOSX_DEPLOYMENT_TARGET=10.9
    BUILD_HOST=""
    EXTRA_CFLAGS=""
    CMAKE_ARCHITECTURE="x86_64"
fi

download_and_extract() {
    local url=$1
    local tar_name=$2

    curl -LO $url
    tar zxvf $tar_name
}

build_library() {
    local dir=$1
    local configure_options=$2

    cd $dir
    CFLAGS=$EXTRA_CFLAGS CXXFLAGS=$EXTRA_CFLAGS ./configure $BUILD_HOST $configure_options
    make -j$JOBS
    cd ..
}

# libogg
download_and_extract "https://downloads.xiph.org/releases/ogg/libogg-$OGGVERSION.tar.gz" "libogg-$OGGVERSION.tar.gz"
build_library "libogg-$OGGVERSION" "--disable-shared --enable-shared"

# libvorbis
download_and_extract "https://downloads.xiph.org/releases/vorbis/libvorbis-$VORBISVERSION.tar.gz" "libvorbis-$VORBISVERSION.tar.gz"
build_library "libvorbis-$VORBISVERSION" "--disable-shared --with-ogg-includes=$OGG_INCDIR --with-ogg-libraries=$OGG_LIBDIR"

# libFLAC
download_and_extract "https://downloads.xiph.org/releases/flac/flac-$FLACVERSION.tar.xz" "flac-$FLACVERSION.tar.xz"
build_library "flac-$FLACVERSION" "--enable-static --disable-shared --with-ogg-includes=$OGG_INCDIR --with-ogg-libraries=$OGG_LIBDIR"

# libopus
download_and_extract "https://downloads.xiph.org/releases/opus/opus-$OPUSVERSION.tar.gz" "opus-$OPUSVERSION.tar.gz"
build_library "opus-$OPUSVERSION" "--disable-shared --enable-static"

# mpg123
download_and_extract "https://sourceforge.net/projects/mpg123/files/mpg123/$MPG123VERSION/mpg123-$MPG123VERSION.tar.bz2" "mpg123-$MPG123VERSION.tar.bz2"
build_library "mpg123-$MPG123VERSION" "--enable-static --disable-shared"

# liblame
download_and_extract "https://sourceforge.net/projects/lame/files/lame/$LAMEVERSION/lame-$LAMEVERSION.tar.gz" "lame-$LAMEVERSION.tar.gz"
build_library "lame-$LAMEVERSION" "--enable-static --disable-shared"

# libsndfile
export FLAC_INCLUDE="$(pwd)/flac-$FLACVERSION/include"
export FLAC_LIBS="$(pwd)/flac-$FLACVERSION/src/libFLAC/.libs/libFLAC.a"
export OGG_INCLUDE="$(pwd)/libogg-$OGGVERSION/include"
export OGG_LIBS="$(pwd)/libogg-$OGGVERSION/src/.libs/libogg.a"
export VORBIS_INCLUDE="$(pwd)/libvorbis-$VORBISVERSION/include"
export VORBIS_LIBS="$(pwd)/libvorbis-$VORBISVERSION/lib/.libs/libvorbis.a"
export VORBISENC_INCLUDE="$(pwd)/libvorbis-$VORBISVERSION/include"
export VORBISENC_LIBS="$(pwd)/libvorbis-$VORBISVERSION/lib/.libs/libvorbisenc.a"
export OPUS_INCLUDE="$(pwd)/opus-$OPUSVERSION"
export OPUS_LIBS="$(pwd)/opus-$OPUSVERSION/.libs/libopus.a"
export MP3LAME_INCLUDE="$(pwd)/lame-$LAMEVERSION"
export MP3LAME_LIBS="$(pwd)/lame-$LAMEVERSION/libmp3lame/.libs/libmp3lame.a"
export MPG123_INCLUDE="$(pwd)/mpg123-$MPG123VERSION/src/libmpg123"
export MPG123_LIBS="$(pwd)/mpg123-$MPG123VERSION/src/libmpg123/.libs/libmpg123.a"

download_and_extract "https://github.com/libsndfile/libsndfile/releases/download/$SNDFILE_VERSION/libsndfile-$SNDFILE_VERSION.tar.xz" "libsndfile-$SNDFILE_VERSION.tar.xz"
cd $SNDFILENAME
cmake -DCMAKE_OSX_ARCHITECTURES=$CMAKE_ARCHITECTURE -DBUILD_SHARED_LIBS=ON -DENABLE_EXTERNAL_LIBS=ON -DENABLE_MPEG=ON -DBUILD_PROGRAMS=OFF -DBUILD_EXAMPLES=OFF -DCMAKE_PROJECT_INCLUDE=../darwin.cmake .
cmake --build . --parallel $JOBS
cd ..

if [ "$1" = "arm64" ]; then
    cp -H $SNDFILENAME/libsndfile.dylib libsndfile_arm64.dylib
    chmod -x libsndfile_arm64.dylib
else
    cp -H $SNDFILENAME/libsndfile.dylib libsndfile.dylib
    chmod -x libsndfile_x86_64.dylib
fi

# Cleanup
rm -rf libogg-$OGGVERSION*
rm -rf libvorbis-$VORBISVERSION*
rm -rf flac-$FLACVERSION*
rm -rf opus-$OPUSVERSION*
rm -rf mpg123-$MPG123VERSION*
rm -rf lame-$LAMEVERSION*
rm -rf $SNDFILENAME*