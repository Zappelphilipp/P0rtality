mkdir .build/volumes/mysql
mkdir .build/volumes/mysql/data

mkdir .build/volumes/nginx/code
mkdir .build/volumes/nginx/code/guest
mkdir .build/volumes/nginx/code/guest/s
mkdir .build/volumes/nginx/code/guest/s/default

cp -R src/* .build/volumes/nginx/code/guest/s/default/
cd .build
docker-compose -p guest_portal up -d
