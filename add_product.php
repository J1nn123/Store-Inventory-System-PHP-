<?php include 'includes/db.php'; ?>

<?php
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $supplier_id = $_POST['supplier_id'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $stmt = $conn->prepare("INSERT INTO products (name, category_id, supplier_id, quantity, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("siiid", $name, $category_id, $supplier_id, $quantity, $price);
    $stmt->execute();
    $stmt->close();

    header("Location: products.php");
    exit();
}

// Fetch categories and suppliers
$categories = $conn->query("SELECT category_id, name FROM categories");
$suppliers = $conn->query("SELECT supplier_id, name FROM suppliers");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Wrapper: Sidebar + Content -->
<div class="flex min-h-screen">

    <!-- Sidebar -->
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 p-10">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="products.php"
                class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-800 text-white px-5 py-2.5 rounded-xl shadow-md hover:from-blue-700 hover:to-blue-900 hover:shadow-lg transition duration-300">
                ← Back
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white shadow-lg rounded-xl p-10 w-full max-w-md mx-auto">
            <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800">Add New Product</h2>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block mb-1 font-medium text-gray-700">Product Name</label>
                    <input type="text" name="name" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Category</label>
                    <select name="category_id" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Select Category</option>
                        <?php while ($row = $categories->fetch_assoc()): ?>
                            <option value="<?= $row['category_id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Supplier</label>
                    <select name="supplier_id" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500">
                        <option value="" disabled selected>Select Supplier</option>
                        <?php while ($row = $suppliers->fetch_assoc()): ?>
                            <option value="<?= $row['supplier_id'] ?>"><?= htmlspecialchars($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" required min="0"
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500" />
                </div>

                <div>
                    <label class="block mb-1 font-medium text-gray-700">Price (₱)</label>
                    <input type="number" name="price" step="0.01" required
                        class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500" />
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                    Add Product
                </button>
            </form>
        </div>
    </div>

</div>

</body>
</html>
