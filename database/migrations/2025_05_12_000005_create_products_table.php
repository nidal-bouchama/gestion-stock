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
Schema::create('products', function (Blueprint $table) {
$table->id();
$table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
$table->string('name', 150)->nullable();
$table->text('description')->nullable();
$table->decimal('price', 10, 2)->nullable();
$table->integer('quantity')->default(0);
$table->binary('image')->nullable();
$table->timestamps();
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('products');
}
};