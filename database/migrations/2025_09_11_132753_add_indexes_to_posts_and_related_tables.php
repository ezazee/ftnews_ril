<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement('CREATE INDEX IF NOT EXISTS posts_status_created_at_idx ON posts (status, created_at DESC)');
        DB::statement('CREATE INDEX IF NOT EXISTS posts_status_view_idx ON posts (status, view DESC)');
        DB::statement('CREATE INDEX IF NOT EXISTS posts_headline_status_id_idx ON posts (headline, status, id DESC)');
        DB::statement('CREATE INDEX IF NOT EXISTS posts_kategori_status_created_at_idx ON posts (kategori_id, status, created_at DESC)');
        DB::statement('CREATE INDEX IF NOT EXISTS posts_slug_idx ON posts (slug)');
        DB::statement('CREATE INDEX IF NOT EXISTS posts_subcategory_status_created_at_idx ON posts (sub_category_id, status, created_at DESC)');
        DB::statement('CREATE INDEX IF NOT EXISTS categories_slug_idx ON categories (slug)');
        DB::statement('CREATE INDEX IF NOT EXISTS categories_nama_idx ON categories (nama_kategori)');
        DB::statement('CREATE INDEX IF NOT EXISTS subcategories_slug_idx ON sub_categories (slug)');
        DB::statement('CREATE INDEX IF NOT EXISTS subcategories_category_idx ON sub_categories (category_id)');
        DB::statement('CREATE INDEX IF NOT EXISTS tags_slug_idx ON tags (slug)');
        DB::statement('CREATE INDEX IF NOT EXISTS tags_nama_idx ON tags (nama_tags)');
        DB::statement('CREATE INDEX IF NOT EXISTS post_tags_post_idx ON post_tags (post_id)');
        DB::statement('CREATE INDEX IF NOT EXISTS post_tags_tag_idx ON post_tags (tags_id)');
    }

    public function down(): void
    {
        DB::statement('DROP INDEX IF EXISTS posts_status_created_at_idx');
        DB::statement('DROP INDEX IF EXISTS posts_status_view_idx');
        DB::statement('DROP INDEX IF EXISTS posts_headline_status_id_idx');
        DB::statement('DROP INDEX IF EXISTS posts_kategori_status_created_at_idx');
        DB::statement('DROP INDEX IF EXISTS posts_slug_idx');
        DB::statement('DROP INDEX IF EXISTS posts_subcategory_status_created_at_idx');
        DB::statement('DROP INDEX IF EXISTS posts_title_content_trgm_idx');
        DB::statement('DROP INDEX IF EXISTS categories_slug_idx');
        DB::statement('DROP INDEX IF EXISTS categories_nama_idx');
        DB::statement('DROP INDEX IF EXISTS subcategories_slug_idx');
        DB::statement('DROP INDEX IF EXISTS subcategories_category_idx');
        DB::statement('DROP INDEX IF EXISTS tags_slug_idx');
        DB::statement('DROP INDEX IF EXISTS tags_nama_idx');
        DB::statement('DROP INDEX IF EXISTS post_tags_post_idx');
        DB::statement('DROP INDEX IF EXISTS post_tags_tag_idx');
    }
};
