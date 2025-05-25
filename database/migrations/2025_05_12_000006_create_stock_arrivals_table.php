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
Schema::create('stock_arrivals', function (Blueprint $table) {
$table->id();
$table->foreignId('supplier_id')->nullable()->constrained('suppliers');
$table->foreignId('product_id')->nullable()->constrained('products');
$table->integer('quantity')->nullable();
$table->date('arrival_date')->nullable();
$table->timestamps();
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::dropIfExists('stock_arrivals');
}
};