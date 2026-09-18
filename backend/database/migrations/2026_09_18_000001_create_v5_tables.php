<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 public function up():void{
  Schema::create('conversations',function(Blueprint $t){$t->uuid('id')->primary();$t->uuid('tenant_id')->index();$t->string('patient_id');$t->string('channel');$t->string('external_thread_id')->nullable();$t->string('status')->default('open');$t->timestamp('last_message_at')->nullable();$t->timestamps();});
  Schema::create('conversation_messages',function(Blueprint $t){$t->uuid('id')->primary();$t->uuid('tenant_id')->index();$t->uuid('conversation_id')->index();$t->string('direction');$t->string('sender_type');$t->string('external_message_id')->nullable();$t->text('body');$t->json('metadata')->nullable();$t->timestamps();});
  Schema::create('usage_records',function(Blueprint $t){$t->uuid('id')->primary();$t->uuid('tenant_id')->index();$t->string('metric');$t->integer('quantity')->default(1);$t->json('metadata')->nullable();$t->timestamps();});
 }
 public function down():void{Schema::dropIfExists('usage_records');Schema::dropIfExists('conversation_messages');Schema::dropIfExists('conversations');}
};
