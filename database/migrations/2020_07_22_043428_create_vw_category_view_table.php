<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVwCategoryViewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE VIEW `vw_product_category`  AS  select `c`.`id` AS `category_id`,`c`.`title` AS `category_title`,`c`.`slug` AS `category_slug`,`c`.`image_link` AS `image_link`,`c`.`banner_link` AS `banner_link`,(select `c_s_r`.`parent_category_id` from `category_self_relation` `c_s_r` where (`c`.`id` = `c_s_r`.`child_category_id`)) AS `parent_category_id`,(select group_concat(`p_c`.`product_id` separator ',') from `product_category` `p_c` where (`c`.`id` = `p_c`.`category_id`)) AS `product_id` from `category` `c` where (`c`.`status` = 'active');");
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
