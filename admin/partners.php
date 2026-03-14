<?php
/*************************************************
 * SESSION & DB
 *************************************************/
session_start();
include '../config/db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

$upload_dir = 'partners/';
if(!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

if(empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(32));

/*************************************************
 * ADD PARTNER
 *************************************************/
if(isset($_POST['add_partner'])){
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $url  = mysqli_real_escape_string($conn, $_POST['url']);
    $display_order = (int)$_POST['display_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    $logo_path = '';
    if(!empty($_FILES['logo']['name'])){
        $logo_name = time().'_'.basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $upload_dir.$logo_name);
        $logo_path = $upload_dir.$logo_name;
    }

    $conn->query("INSERT INTO partners (category_name, name, logo_path, url, display_order, status) 
                  VALUES ('$category_name','$name','$logo_path','$url','$display_order','$status')");

    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

/*************************************************
 * EDIT PARTNER
 *************************************************/
if(isset($_POST['edit_partner'])){
    $id = (int)$_POST['partner_id'];
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $url  = mysqli_real_escape_string($conn, $_POST['url']);
    $display_order = (int)$_POST['display_order'];
    $status = isset($_POST['status']) ? 1 : 0;

    $update_logo = "";
    if(!empty($_FILES['logo']['name'])){
        $logo_name = time().'_'.basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $upload_dir.$logo_name);
        $logo_path = $upload_dir.$logo_name;
        $update_logo = ", logo_path='$logo_path'";
    }

    $conn->query("UPDATE partners SET 
                  category_name='$category_name', 
                  name='$name', 
                  url='$url', 
                  display_order='$display_order', 
                  status='$status' 
                  $update_logo 
                  WHERE partner_id='$id'");

    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

/*************************************************
 * DELETE PARTNER
 *************************************************/
if(isset($_POST['delete_partner'])){
    if(!hash_equals($_SESSION['csrf'], $_POST['csrf'])) die("Invalid CSRF");
    $id = (int)$_POST['partner_id'];
    $res = $conn->query("SELECT logo_path FROM partners WHERE partner_id='$id'");
    $row = $res->fetch_assoc();
    if($row && file_exists($row['logo_path'])) unlink($row['logo_path']);
    $conn->query("DELETE FROM partners WHERE partner_id='$id'");
    header("Location: " . $_SERVER['PHP_SELF']); exit;
}

$result = $conn->query("SELECT * FROM partners ORDER BY category_name ASC, display_order ASC");
$partners = [];
while($row = $result->fetch_assoc()){
    $partners[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Partners | NGA Admin</title>

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
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">Partner Management</h2>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
                
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-0 overflow-hidden">
                        <div class="bg-blue-600 px-6 py-4 flex items-center gap-2">
                            <i class="fas fa-handshake text-white"></i>
                            <h3 class="text-white font-semibold">Add New Partner</h3>
                        </div>
                        <div class="p-6">
                            <form method="post" enctype="multipart/form-data" class="space-y-4">
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                                    <input type="text" name="category_name" placeholder="e.g. Silver Partner" required
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Partner Name</label>
                                    <input type="text" name="name" placeholder="Enter partner name" required
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Logo</label>
                                    <input type="file" name="logo" required
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer border border-gray-200 rounded-xl p-1 bg-gray-50">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Website URL</label>
                                    <input type="text" name="url" placeholder="https://..."
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Display Order</label>
                                    <input type="number" name="display_order" value="0"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                </div>
                                
                                <div class="pt-2">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="status" class="sr-only peer" checked>
                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                        <span class="ml-3 text-sm font-semibold text-gray-700">Set as Active</span>
                                    </label>
                                </div>
                                
                                <button type="submit" name="add_partner" class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-xl transition-colors shadow-md shadow-green-500/20 mt-4">
                                    Save Partner
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        
                        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h5 class="font-bold text-gray-800 text-lg">Partner Directory</h5>
                            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                                <?= count($partners) ?> Total Partners
                            </span>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                                        <th class="px-6 py-4 font-semibold">Logo</th>
                                        <th class="px-6 py-4 font-semibold">Partner Details</th>
                                        <th class="px-6 py-4 font-semibold text-center">Order</th>
                                        <th class="px-6 py-4 font-semibold text-center">Status</th>
                                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php if(empty($partners)): ?>
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No partners found. Add your first partner on the left.</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach($partners as $row): ?>
                                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                                
                                                <td class="px-6 py-3">
                                                    <div class="w-14 h-14 rounded-lg bg-white border border-gray-200 p-1 flex items-center justify-center shadow-sm">
                                                        <?php if(!empty($row['logo_path'])): ?>
                                                            <img src="<?= $row['logo_path'] ?>" class="max-w-full max-h-full object-contain">
                                                        <?php else: ?>
                                                            <i class="fas fa-image text-gray-300"></i>
                                                        <?php endif; ?>
                                                    </div>
                                                </td>
                                                
                                                <td class="px-6 py-3">
                                                    <div class="font-bold text-gray-800"><?= htmlspecialchars($row['name']) ?></div>
                                                    <div class="text-xs text-gray-500 mt-0.5"><?= htmlspecialchars($row['category_name']) ?></div>
                                                    <?php if(!empty($row['url'])): ?>
                                                        <a href="<?= htmlspecialchars($row['url']) ?>" target="_blank" class="text-[10px] text-blue-500 hover:underline mt-1 inline-block"><i class="fas fa-external-link-alt"></i> Visit Site</a>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <td class="px-6 py-3 text-center text-sm font-medium text-gray-600">
                                                    <?= $row['display_order'] ?>
                                                </td>
                                                
                                                <td class="px-6 py-3 text-center">
                                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?= $row['status'] ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' ?>">
                                                        <?= $row['status'] ? 'Active' : 'Inactive' ?>
                                                    </span>
                                                </td>
                                                
                                                <td class="px-6 py-3 text-right">
                                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <button onclick="openModal(<?= $row['partner_id'] ?>)" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white flex items-center justify-center transition-colors tooltip" title="Edit">
                                                            <i class="fas fa-edit text-sm"></i>
                                                        </button>
                                                        <form method="post" onsubmit="return confirm('Delete this partner?');" class="m-0">
                                                            <input type="hidden" name="partner_id" value="<?= $row['partner_id'] ?>">
                                                            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
                                                            <button name="delete_partner" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors tooltip" title="Delete">
                                                                <i class="fas fa-trash-alt text-sm"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                
            </div>
        </main>
    </div>

    <?php foreach($partners as $row): ?>
        <div id="editModal-<?= $row['partner_id'] ?>" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden opacity-0 transition-opacity duration-300 px-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg overflow-hidden transform scale-95 transition-transform duration-300" id="editModalContent-<?= $row['partner_id'] ?>">
                
                <div class="bg-gray-50 border-b border-gray-100 px-6 py-4 flex justify-between items-center">
                    <h5 class="font-bold text-gray-800">Edit Partner</h5>
                    <button type="button" onclick="closeModal(<?= $row['partner_id'] ?>)" class="text-gray-400 hover:text-red-500 transition-colors">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
                
                <form method="post" enctype="multipart/form-data" class="p-6 space-y-4">
                    <input type="hidden" name="partner_id" value="<?= $row['partner_id'] ?>">
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Category</label>
                            <input type="text" name="category_name" value="<?= htmlspecialchars($row['category_name']) ?>" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                        </div>
                        
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Partner Name</label>
                            <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                        </div>
                        
                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Update Logo <span class="text-xs font-normal text-gray-400">(leave blank to keep current)</span></label>
                            <input type="file" name="logo"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-200 file:text-gray-700 hover:file:bg-gray-300 transition-all cursor-pointer border border-gray-200 rounded-xl p-1 bg-gray-50">
                        </div>

                        <div class="col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Website URL</label>
                            <input type="text" name="url" value="<?= htmlspecialchars($row['url']) ?>"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Display Order</label>
                            <input type="number" name="display_order" value="<?= $row['display_order'] ?>"
                                class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                        </div>

                        <div class="flex items-end pb-2 pl-2">
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="status" class="sr-only peer" <?= $row['status'] ? 'checked' : '' ?>>
                                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                <span class="ml-3 text-sm font-semibold text-gray-700">Active</span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3 border-t border-gray-100 pt-5 mt-5">
                        <button type="button" onclick="closeModal(<?= $row['partner_id'] ?>)" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-colors text-sm">Cancel</button>
                        <button type="submit" name="edit_partner" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-colors shadow-md shadow-blue-500/20 text-sm">Update Partner</button>
                    </div>
                </form>

            </div>
        </div>
    <?php endforeach; ?>

    <script>
        function openModal(id) {
            const modal = document.getElementById('editModal-' + id);
            const content = document.getElementById('editModalContent-' + id);
            
            modal.classList.remove('hidden');
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
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    </script>
</body>
</html>