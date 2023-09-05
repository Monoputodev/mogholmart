<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwAdminProductSearchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE  VIEW `vw_admin_product_search`  AS  
            SELECT `p`.`id` AS `product_id`,
            `p`.`title` AS `product_title`,
            `p`.`merchant_id` AS `product_merchant_id`,
            `p`.`weight` AS `weight`,
            `p`.`status` AS `status`,
            `p`.`slug` AS `product_slug`,(SELECT `m`.`title` FROM `manufacturer` `m` WHERE (`p`.`manufacturer_id` = `m`.`id`)) AS `manufacturer`,
            (SELECT `attribute`.`title` FROM `attribute_set` `attribute` WHERE (`p`.`attribute_set_id` = `attribute`.`id`)) AS `attribute_title`,
            (SELECT GROUP_CONCAT(`b`.`title` SEPARATOR ',') FROM (`brand` `b` JOIN `product_brand` `p_b` ON((`b`.`id` = `p_b`.`brand_id`))) WHERE (`p_b`.`product_id` = `p`.`id`)) AS `brand`,
            (SELECT GROUP_CONCAT(`c`.`id` SEPARATOR ',') FROM (`category` `c` JOIN `product_category` `p_c` ON((`c`.`id` = `p_c`.`category_id`))) WHERE (`p_c`.`product_id` = `p`.`id`)) AS `category_id`,
            (SELECT GROUP_CONCAT(`c`.`title` SEPARATOR ',') FROM (`category` `c` JOIN `product_category` `p_c` ON((`c`.`id` = `p_c`.`category_id`))) WHERE (`p_c`.`product_id` = `p`.`id`)) AS `category_title`,
            (SELECT GROUP_CONCAT(`c`.`meta_keywords` SEPARATOR ',') FROM (`category` `c` JOIN `product_category` `p_c` ON((`c`.`id` = `p_c`.`category_id`))) WHERE (`p_c`.`product_id` = `p`.`id`)) AS `cat_meta_keywords`,
            `p`.`item_no` AS `item_no`,`p`.`sell_price` AS `sell_price`,
            `p`.`list_price` AS `list_price`,
            `p`.`offer_price` AS `offer_price`,
            (SELECT `p_s`.`meta_title` FROM `product_seo` `p_s` WHERE (`p`.`id` = `p_s`.`product_id`)) AS `meta_title`,
            (SELECT `p_s`.`meta_keywords` FROM `product_seo` `p_s` WHERE (`p`.`id` = `p_s`.`product_id`)) AS `meta_keywords`,
            (SELECT `p_s`.`meta_description` FROM `product_seo` `p_s` WHERE (`p`.`id` = `p_s`.`product_id`)) AS `meta_description`,
            (SELECT `p_in`.`quantity` FROM `product_inventory` `p_in` WHERE (`p`.`id` = `p_in`.`product_id`)) AS `quantity`,
            (SELECT COUNT(`p_review`.`id`) FROM `product_review` `p_review` WHERE ((`p`.`id` = `p_review`.`product_id`) AND (`p_review`.`status` = 'active'))) AS `total_review`,
            (SELECT `p_i`.`image` FROM `product_image` `p_i` WHERE (`p`.`id` = `p_i`.`product_id`) LIMIT 1) AS `image`,
            (SELECT AVG(`p_review`.`rating_value_score`) FROM `product_review` `p_review` WHERE ((`p`.`id` = `p_review`.`product_id`) AND (`p_review`.`status` = 'active'))) AS `average_review` FROM `product` `p` ;");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW vw_product_category");
    }
}
