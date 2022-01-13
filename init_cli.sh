#!/bin/sh

# This shell-script fixes ssh cli issues when connected

export HOME=/home/vcap/app

touch /home/vcap/app/.vimrc
echo "set nocompatible" > /home/vcap/app/.vimrc
echo "set backspace=indent,eol,start" >> /home/vcap/app/.vimrc

source /home/vcap/app/.vimrc
source /home/vcap/app/.profile.d/finalize_bp_env_vars.sh