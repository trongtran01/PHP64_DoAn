docker cp /home/wgt-dev/Documents/Trong_DK/Goods_Shop/src/php64_laravel_doan_new.sql
docker compose exec app bash
docker compose up -d --build
docker compose exec db bash
mysql -u root -proot laravel < /laravel.sql
newpassword123