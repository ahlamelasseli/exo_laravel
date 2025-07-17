  SQLSTATE[HY000]: General error: 1 table "products" already exists (Connection: sqlite, SQL: create table "products" ("id" integer primary key autoincrement not null, "name" varchar not null, "description" text not null, "price" numeric not null, "user_id" integer not null, "created_at" datetime, "updated_at" datetime, foreign key("user_id") references "users"("id")))

  at vendor\laravel\framework\src\Illuminate\Database\Connection.php:822
    818▕                     $this->getName(), $query, $this->prepareBindings($bindings), $e
    819▕                 );
    820▕             }
    821▕
  ➜ 822▕             throw new QueryException(
    823▕                 $this->getName(), $query, $this->prepareBindings($bindings), $e
    824▕             );
    825▕         }
    826▕     }

  1   vendor\laravel\framework\src\Illuminate\Database\Connection.php:562
      PDOException::("SQLSTATE[HY000]: General error: 1 table "products" already exists")

  2   vendor\laravel\framework\src\Illuminate\Database\Connection.php:562
      PDO::prepare("create table "products" ("id" integer primary key autoincrement not null, "name" varchar not null, "description" text not null, "price" numeric not null, "user_id" integer not null, "created_at" datetime, "updated_at" datetime, foreign key("user_id") references "users"("id"))")
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->default(3)->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
};

