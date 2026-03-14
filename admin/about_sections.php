<?php
include "../config/db.php"; // your db connection
session_start();
if(!isset($_SESSION['admin'])){ header("Location: login.php"); exit; }

$target_dir = "../uploads/icons/"; // Ensure this folder exists

// Handle Add
if(isset($_POST['add'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $display_order = (int)$_POST['display_order'];
    
    $icon = "";
    if(!empty($_FILES["icon"]["name"])){
        $icon = time() . "_" . basename($_FILES["icon"]["name"]);
        move_uploaded_file($_FILES["icon"]["tmp_name"], $target_dir . $icon);
    }

    mysqli_query($conn, "INSERT INTO why_partner_nga (title, description, icon, display_order) VALUES ('$title', '$description', '$icon', $display_order)");
    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

// Handle Update
if(isset($_POST['update'])){
    $id = (int)$_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $display_order = (int)$_POST['display_order'];
    $old_icon = $_POST['old_icon'];

    if(!empty($_FILES["icon"]["name"])){
        $icon = time() . "_" . basename($_FILES["icon"]["name"]);
        move_uploaded_file($_FILES["icon"]["tmp_name"], $target_dir . $icon);
        if($old_icon && file_exists($target_dir . $old_icon)) unlink($target_dir . $old_icon);
    } else {
        $icon = $old_icon;
    }

    mysqli_query($conn, "UPDATE why_partner_nga SET title='$title', description='$description', icon='$icon', display_order=$display_order WHERE id=$id");
    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

// Handle Delete
if(isset($_POST['delete'])){
    $id = (int)$_POST['id'];
    $old_icon = $_POST['old_icon'];
    if($old_icon && file_exists($target_dir . $old_icon)) unlink($target_dir . $old_icon);
    mysqli_query($conn, "DELETE FROM why_partner_nga WHERE id=$id");
    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

$result = mysqli_query($conn, "SELECT * FROM why_partner_nga ORDER BY display_order ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - Why Partner NGA</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'], },
                    colors: {
                        primary: '#0B2C4D',
                        ngaBlue: '#4a90e2',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-primary text-white flex-shrink-0 h-full overflow-y-auto shadow-xl z-20">
        <?php include 'modules/sidebar.php'; ?>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden relative">
        
        <header class="bg-white h-16 border-b border-gray-200 flex items-center px-8 shadow-sm z-10 flex-shrink-0">
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">Manage 'Why Partner NGA' Sections</h2>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
                
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-0 overflow-hidden">
                        <div class="bg-blue-600 px-6 py-4 flex items-center gap-2">
                            <i class="fas fa-plus-circle text-white"></i>
                            <h3 class="text-white font-semibold">Add New Section</h3>
                        </div>
                        <div class="p-6">
                            <form method="post" enctype="multipart/form-data" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                                    <input type="text" name="title" required placeholder="Enter title"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                                    <textarea name="description" required placeholder="Enter description" rows="4"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm resize-none"></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Icon Image</label>
                                    <input type="file" name="icon" accept="image/*" required
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer border border-gray-200 rounded-xl p-1 bg-gray-50">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Display Order</label>
                                    <input type="number" name="display_order" value="0"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                </div>
                                
                                <button type="submit" name="add" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl transition-colors shadow-md shadow-green-500/20 mt-2">
                                    Add Section
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3">
                    <h4 class="text-gray-500 text-sm font-semibold uppercase tracking-wider mb-4">Existing Sections</h4>
                    
                    <div class="space-y-4">
                        <?php if(mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative group">
                                <div class="absolute left-0 top-0 bottom-0 w-1 bg-blue-500"></div>
                                
                                <div class="px-6 py-4 border-b border-gray-50 flex justify-between items-center bg-gray-50/50">
                                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider">Section ID #<?php echo $row['id']; ?></span>
                                    <div class="w-10 h-10 bg-white border border-gray-100 rounded-lg p-1 shadow-sm flex items-center justify-center">
                                        <img src="../uploads/icons/<?php echo $row['icon']; ?>" class="max-w-full max-h-full object-contain" alt="icon">
                                    </div>
                                </div>
                                
                                <div class="p-6">
                                    <form method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                        <input type="hidden" name="old_icon" value="<?php echo $row['icon']; ?>">
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                            
                                            <div class="md:col-span-7">
                                                <label class="block text-xs font-semibold text-gray-500 mb-1">Title</label>
                                                <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>"
                                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                            </div>
                                            
                                            <div class="md:col-span-5">
                                                <label class="block text-xs font-semibold text-gray-500 mb-1">Change Icon</label>
                                                <input type="file" name="icon"
                                                    class="w-full text-xs text-gray-500 file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 border border-gray-200 rounded-lg p-1 bg-gray-50">
                                            </div>
                                            
                                            <div class="md:col-span-10">
                                                <label class="block text-xs font-semibold text-gray-500 mb-1">Description</label>
                                                <textarea name="description" rows="2"
                                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm resize-none"><?php echo htmlspecialchars($row['description']); ?></textarea>
                                            </div>
                                            
                                            <div class="md:col-span-2">
                                                <label class="block text-xs font-semibold text-gray-500 mb-1">Order</label>
                                                <input type="number" name="display_order" value="<?php echo $row['display_order']; ?>"
                                                    class="w-full px-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-center">
                                            </div>
                                            
                                            <div class="md:col-span-12 flex items-center justify-end gap-3 mt-2 border-t border-gray-50 pt-4">
                                                <button type="submit" name="update" class="flex items-center gap-2 bg-blue-50 hover:bg-blue-600 text-blue-600 hover:text-white px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
                                                    <i class="fas fa-save"></i> Update
                                                </button>
                                                
                                                <button type="submit" name="delete" onclick="return confirm('Are you sure you want to delete this section?');" class="flex items-center gap-2 bg-red-50 hover:bg-red-500 text-red-500 hover:text-white px-4 py-2 rounded-lg font-semibold text-sm transition-colors">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </div>
                                            
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="bg-blue-50 text-blue-600 p-6 rounded-2xl flex items-center gap-3 border border-blue-100">
                                <i class="fas fa-info-circle text-xl"></i>
                                <p class="font-medium">No 'Why Partner' sections found. Use the panel on the left to add your first one!</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </main>
    </div>

</body>
</html>