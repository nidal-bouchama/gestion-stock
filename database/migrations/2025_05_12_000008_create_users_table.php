use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{
Schema::create('users', function (Blueprint $table) {
$table->id();
$table->string('name', 100)->nullable();
$table->string('email', 150)->nullable()->unique();
$table->string('password', 255)->nullable();
$table->enum('role', ['admin', 'super_admin'])->default('admin');
$table->rememberToken();
$table->timestamps();
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('users');
}
};