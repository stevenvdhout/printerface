#!/bin/bash
cd /media/GOOFY/printerface
cd uploads
filelist=`ls | egrep '.(jpg|JPG)'`
cd ..
for image in $filelist
do

dim=$(identify uploads/$image | cut -f 3 -d' ')
w=$(echo $dim | cut -d 'x' -f 1)
h=$(echo $dim | cut -d 'x' -f 2)

if [ $w -gt $h ]; then
  echo 'landscape'
  inname=`convert uploads/$image -format "%t" info:`
  convert uploads/$image -resize 2480x1748^ -gravity center -extent 2480x1748 -page 0+0 assets/overlay-landscape.png -layers coalesce -flatten rendered/${inname}.jpg
  mv uploads/$image processed/$image
else
  echo 'portrait'
  inname=`convert uploads/$image -format "%t" info:`
  convert uploads/$image -resize 1748x2480^ -gravity center -extent 1748x2480 -page 0+0 assets/overlay-portrait.png -layers coalesce -flatten rendered/${inname}.jpg
  mv uploads/$image processed/$image
fi

done
