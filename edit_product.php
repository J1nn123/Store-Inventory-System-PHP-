<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<?php
$product_id = $_GET['id'];

$query = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $supplier_id = $_POST['supplier_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE products SET name = ?, category_id = ?, supplier_id = ?, quantity = ?, price = ? WHERE product_id = ?");
    $stmt->bind_param("siiidi", $name, $category_id, $supplier_id, $quantity, $price, $product_id);
    $stmt->execute();
    $stmt->close();

    header("Location: products.php");
    exit();
}
?>

<div class="flex-1 p-10">
  <div class="max-w-xl mx-auto bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold text-gray-700 mb-6">Edit Product</h2>
    
    <form method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700">Product Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($product['name']) ?>" required
               class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Category ID</label>
        <input type="number" name="category_id" value="<?= $product['category_id'] ?>" required
               class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Supplier ID</label>
        <input type="number" name="supplier_id" value="<?= $product['supplier_id'] ?>" required
               class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Quantity</label>
        <input type="number" name="quantity" value="<?= $product['quantity'] ?>" required
               class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Price</label>
        <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required
               class="w-full border border-gray-300 rounded px-3 py-2 mt-1 focus:outline-none focus:ring focus:border-blue-300">
      </div>

      <div class="pt-4">
        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition w-full">
          Update Product
        </button>
      </div>
    </form>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
