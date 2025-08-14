<?php
include 'includes/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact_info'];
    $email = $_POST['email'];
    $stmt = $conn->prepare("INSERT INTO suppliers (name, contact_info, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $contact, $email);
    $stmt->execute();
    header("Location: suppliers.php");
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/sidebar.php'; ?>


<div class="p-10">
    <h2 class="text-xl font-bold mb-4">Add Supplier</h2>
    <form method="POST" class="space-y-4">
        <input name="name" placeholder="Name" class="border px-4 py-2 w-full" required>
        <input name="contact_info" placeholder="Contact Numbers" class="border px-4 py-2 w-full" required>
        <input name="email" placeholder="Email" type="email" class="border px-4 py-2 w-full">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
