# -*- shell-script -*-
  
#
# shell script command line parameter-processing for
#
# wiki_import.sh - mediawiki automatic file import script
#
# @Author:  Tong SUN, (c) 2006-2007
# @Release: $ $Revision: 1.1 $, under the BSD license
# @HomeURL: http://xpt.sourceforge.net/
#
# @Description: The script is designed to import a whole folder of     
#               files into mediawiki, with the folder directory tree   
#               mapped as wiki category hierarchy. The specification of
#               the file-to-import is passed from standard input.      
#
  
_opt_res="$_opt_sect"
  
eval set -- `getopt \
  -o +s:1lfR::p:r:m:u:a: --long \
    sect:,header,link,footer,res::,php:,root:,max:,user:,arch: \
  -- "$@"`
  
while :; do
  case "$1" in
  
  # == Options
  --sect|-s)           # the root category section of the wiki
    shift; _opt_sect="$1"
    ;;
  --header|-1)         # include standard header (category hierarchy path & notice)
    _opt_header=T
    ;;
  --link|-l)           # link to actual file on the web site
    _opt_link=T
    ;;
  --footer|-f)         # include standard footer (article category)
    _opt_footer=T
    ;;
  --res|-R)            # add restricted tag in the footer
    shift; _opt_res="$1"
    _opt_res_set=T
    [ "$_opt_res" ] || _opt_res="$_opt_sect"
    ;;
  
  # == Configuration Options
  --php|-p)            # mediawiki import php script specification
    shift; _opt_php="$1"
    ;;
  --root|-r)           # the root category name for the whole wiki site
    shift; _opt_root="$1"
    ;;
  --max|-m)            # max_allowed_packet for mysqld to import
    shift; _opt_max="$1"
    ;;
  --user|-u)           # wiki user used for the import
    shift; _opt_user="$1"
    ;;
  --arch|-a)           # the root url that linked-to archive files based on
    shift; _opt_arch="$1"
    ;;
  
  # == Examples
  --) 
    shift; break 
    ;;
  *) 
    echo "Internal getopt error ($1)!"; exit 1
    ;;
  esac
  shift
done
  
[ "$_opt_sect" ] || {
  echo "Mandatory option --sect is not set."
  _opt_check_failed=T
}
  
[ "$_opt_debug" ] && {
  echo "[wiki_import.sh] debug: _opt_sect=$_opt_sect"
  echo "[wiki_import.sh] debug: _opt_header=$_opt_header"
  echo "[wiki_import.sh] debug: _opt_link=$_opt_link"
  echo "[wiki_import.sh] debug: _opt_footer=$_opt_footer"
  echo "[wiki_import.sh] debug: _opt_res=$_opt_res"
  echo "[wiki_import.sh] debug: _opt_php=$_opt_php"
  echo "[wiki_import.sh] debug: _opt_root=$_opt_root"
  echo "[wiki_import.sh] debug: _opt_max=$_opt_max"
  echo "[wiki_import.sh] debug: _opt_user=$_opt_user"
  echo "[wiki_import.sh] debug: _opt_arch=$_opt_arch"
}
  
#if [ "$_opt_check_failed" ]; then 
#  echo "Not all mandatory options are set."
#fi
 
# End
