<?php
/*************************************************
 * SECURITY & DB
 *************************************************/
session_start();
include "../config/db.php";

if(!isset($_SESSION['admin'])){
    header("Location: ../login.php");
    exit;
}

$upload_dir = "uploads/program_icons/";
if(!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);

/*************************************************
 * CSRF TOKEN
 *************************************************/
if(empty($_SESSION['csrf'])){
    $_SESSION['csrf'] = bin2hex(random_bytes(32));
}

/*************************************************
 * LOGIC (ADD / UPDATE / DELETE)
 *************************************************/
if(isset($_POST['add'])){
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0;
    $icon = '';
    if(!empty($_FILES['icon']['name'])){
        $icon = time().'_'.basename($_FILES['icon']['name']);
        move_uploaded_file($_FILES['icon']['tmp_name'], $upload_dir.$icon);
    }
    mysqli_query($conn,"INSERT INTO programs (title, description, icon, status) VALUES ('$title','$description','$icon','$status')");
    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

if(isset($_POST['update'])){
    $id = (int)$_POST['id'];
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0;
    if(!empty($_FILES['icon']['name'])){
        $icon = time().'_'.basename($_FILES['icon']['name']);
        move_uploaded_file($_FILES['icon']['tmp_name'], $upload_dir.$icon);
        mysqli_query($conn,"UPDATE programs SET title='$title', description='$description', icon='$icon', status='$status' WHERE id=$id");
    } else {
        mysqli_query($conn,"UPDATE programs SET title='$title', description='$description', status='$status' WHERE id=$id");
    }
    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

if(isset($_POST['delete_id'])){
    if(!hash_equals($_SESSION['csrf'], $_POST['csrf'])){ die("Invalid CSRF"); }
    $id = (int)$_POST['delete_id'];
    $res = mysqli_query($conn, "SELECT icon FROM programs WHERE id=$id");
    $row = mysqli_fetch_assoc($res);
    if($row['icon'] && file_exists($upload_dir.$row['icon'])) unlink($upload_dir.$row['icon']);
    mysqli_query($conn, "DELETE FROM programs WHERE id=$id");
    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

$result = mysqli_query($conn,"SELECT * FROM programs ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Programs | NGA Admin</title>

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
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">Programs Management</h2>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
                
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-0 overflow-hidden">
                        <div class="bg-blue-600 px-6 py-4 flex items-center gap-2">
                            <i class="fas fa-plus-circle text-white"></i>
                            <h3 class="text-white font-semibold">Add New Program</h3>
                        </div>
                        <div class="p-6">
                            <form method="post" enctype="multipart/form-data" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Program Title</label>
                                    <input type="text" name="title" required placeholder="Enter title"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                                    <textarea name="description" required placeholder="Brief details..." rows="4"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm resize-none"></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Program Icon</label>
                                    <input type="file" name="icon" accept="image/*"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer border border-gray-200 rounded-xl p-1 bg-gray-50">
                                </div>
                                
                                <div class="pt-2">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="status" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                        <span class="ml-3 text-sm font-semibold text-gray-700">Set as Active</span>
                                    </label>
                                </div>
                                
                                <button type="submit" name="add" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl transition-colors shadow-md shadow-green-500/20 mt-4">
                                    Create Program
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3">
                    <div class="flex justify-between items-center mb-6">
                        <h4 class="text-gray-500 text-sm font-semibold uppercase tracking-wider">Existing Programs</h4>
                        <span class="bg-gray-200 text-gray-700 text-xs font-bold px-3 py-1 rounded-full">
                            <?= mysqli_num_rows($result) ?> Total
                        </span>
                    </div>

                    <div class="space-y-4">
                        <?php if(mysqli_num_rows($result) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($result)): ?>
                            
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative group transition-all hover:shadow-md">
                                <div class="absolute left-0 top-0 bottom-0 w-1.5 <?= $row['status'] ? 'bg-green-500' : 'bg-gray-300' ?>"></div>
                                
                                <div class="p-5 pl-8 flex items-center gap-5">
                                    <div class="w-16 h-16 flex-shrink-0 rounded-xl overflow-hidden border border-gray-100 bg-gray-50 flex items-center justify-center">
                                        <?php if($row['icon']): ?>
                                            <img src="<?= $upload_dir.$row['icon'] ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <i class="fas fa-image text-gray-300 text-2xl"></i>
                                        <?php endif; ?>
                                    </div>

                                    <div class="flex-grow">
                                        <div class="flex justify-between items-start mb-1">
                                            <h5 class="font-bold text-gray-800 text-lg"><?= htmlspecialchars($row['title']) ?></h5>
                                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?= $row['status'] ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' ?>">
                                                <?= $row['status'] ? 'Active' : 'Inactive' ?>
                                            </span>
                                        </div>
                                        <p class="text-gray-500 text-sm leading-relaxed mb-0">
                                            <?= mb_strimwidth(htmlspecialchars($row['description']), 0, 120, "...") ?>
                                        </p>
                                    </div>

                                    <div class="flex flex-col gap-2 border-l border-gray-100 pl-4 flex-shrink-0">
                                        <button onclick="openModal(<?= $row['id'] ?>)" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors tooltip" title="Edit">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                        <form method="post" onsubmit="return confirm('Delete this program? This action cannot be undone.');">
                                            <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                                            <button class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors tooltip" title="Delete">
                                                <i class="fas fa-trash-alt text-sm"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div id="editModal-<?= $row['id'] ?>" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300 px-4">
                                <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform scale-95 transition-transform duration-300" id="editModalContent-<?= $row['id'] ?>">
                                    
                                    <div class="bg-gray-50 border-b border-gray-100 px-6 py-4 flex justify-between items-center">
                                        <h5 class="font-bold text-gray-800">Update Program</h5>
                                        <button onclick="closeModal(<?= $row['id'] ?>)" class="text-gray-400 hover:text-red-500 transition-colors">
                                            <i class="fas fa-times text-xl"></i>
                                        </button>
                                    </div>
                                    
                                    <form method="post" enctype="multipart/form-data" class="p-6 space-y-4">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                                            <input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>" required
                                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                                            <textarea name="description" rows="4" required
                                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm resize-none"><?php echo htmlspecialchars($row['description']); ?></textarea>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-700 mb-1">Change Icon</label>
                                            <input type="file" name="icon"
                                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 transition-all cursor-pointer border border-gray-200 rounded-xl p-1 bg-gray-50">
                                        </div>
                                        
                                        <div class="pt-2">
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" name="status" class="sr-only peer" <?= $row['status'] ? 'checked' : '' ?>>
                                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                                <span class="ml-3 text-sm font-semibold text-gray-700">Program Active</span>
                                            </label>
                                        </div>
                                        
                                        <div class="flex justify-end gap-3 border-t border-gray-100 pt-5 mt-5">
                                            <button type="button" onclick="closeModal(<?= $row['id'] ?>)" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors text-sm">Cancel</button>
                                            <button type="submit" name="update" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-colors shadow-md shadow-blue-500/20 text-sm">Save Changes</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <div class="bg-blue-50 text-blue-600 p-8 rounded-2xl flex flex-col items-center justify-center text-center border border-blue-100">
                                <i class="fas fa-folder-open fa-3x mb-3 opacity-50"></i>
                                <h5 class="font-bold text-lg mb-1">No Programs Found</h5>
                                <p class="text-sm opacity-80">Use the form on the left to add your first educational program.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
            </div>
        </main>
    </div>

    <script>
        function openModal(id) {
            const modal = document.getElementById('editModal-' + id);
            const content = document.getElementById('editModalContent-' + id);
            
            modal.classList.remove('hidden');
            // Small delay to allow display block to apply before changing opacity for smooth transition
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeModal(id) {
            const modal = document.getElementById('editModal-' + id);
            const content = document.getElementById('editModalContent-' + id);
            
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            
            // Wait for transition to finish before hiding
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html>