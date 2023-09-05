<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwProductViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE  VIEW `vw_product`  AS  select `p`.`id` AS `product_id`,
            `p`.`title` AS `product_title`,
            `p`.`merchant_id` AS `product_merchant_id`,
            `p`.`slug` AS `product_slug`,
            `p`.`short_description` AS `short_description`,
            `p`.`specification` AS `specification`,
            `p`.`description` AS `description`,
            (select `m`.`title` from `manufacturer` `m` where (`p`.`manufacturer_id` = `m`.`id`)) AS `manufacturer`,
            (select group_concat(`b`.`title` separator ',') from (`brand` `b` join `product_brand` `p_b` on((`b`.`id` = `p_b`.`brand_id`))) where (`p_b`.`product_id` = `p`.`id`)) AS `brand`,
            (select group_concat(`c`.`id` separator ',') from (`category` `c` join `product_category` `p_c` on((`c`.`id` = `p_c`.`category_id`))) where (`p_c`.`product_id` = `p`.`id`)) AS `category_id`,
            (select group_concat(`c`.`title` separator ',') from (`category` `c` join `product_category` `p_c` on((`c`.`id` = `p_c`.`category_id`))) where (`p_c`.`product_id` = `p`.`id`)) AS `category_title`,
            `p`.`item_no` AS `item_no`,
            `p`.`weight` AS `weight`,
            `p`.`sell_price` AS `sell_price`,
            `p`.`list_price` AS `list_price`,
            `p`.`offer_price` AS `offer_price`,
            (select `p_i`.`image` from `product_image` `p_i` where (`p`.`id` = `p_i`.`product_id`) limit 1) AS `image`,
            (select `p_s`.`meta_title` from `product_seo` `p_s` where (`p`.`id` = `p_s`.`product_id`)) AS `meta_title`,
            (select `p_s`.`meta_keywords` from `product_seo` `p_s` where (`p`.`id` = `p_s`.`product_id`)) AS `meta_keywords`,
            (select `p_s`.`meta_description` from `product_seo` `p_s` where (`p`.`id` = `p_s`.`product_id`)) AS `meta_description`,
            (select `p_in`.`quantity` from `product_inventory` `p_in` where (`p`.`id` = `p_in`.`product_id`)) AS `quantity`,
            (select count(`p_review`.`id`) from `product_review` `p_review` where ((`p`.`id` = `p_review`.`product_id`) and (`p_review`.`status` = 'active'))) AS `total_review`,
            (select avg(`p_review`.`rating_value_score`) from `product_review` `p_review` where ((`p`.`id` = `p_review`.`product_id`) and (`p_review`.`status` = 'active')))
            AS `average_review` from `product` `p` 
            where ((`p`.`status` = 'active') 
            and (`p`.`title` <> '')) ;
            ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW vw_product");
    }
}
