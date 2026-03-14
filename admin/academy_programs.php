<?php
session_start();
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

// Database connection
$host = "localhost";
$dbname = "ngarw_spes";
$user = "ngarw_spes";
$pass = "ngarw_spes";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

$status_msg = '';

// ==========================================
// 1. HANDLE CRUD OPERATIONS
// ==========================================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // CREATE: Add New Program
    if (isset($_POST['add_program'])) {
        $program_number = trim($_POST['program_number']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $image_url = trim($_POST['image_url']);
        $link_url = trim($_POST['link_url']);
        $status = isset($_POST['status']) ? 1 : 0; // Checkbox to tinyint
        
        $stmt = $pdo->prepare("INSERT INTO academy_programs (program_number, title, description, image_url, link_url, status) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$program_number, $title, $description, $image_url, $link_url, $status])) {
            $status_msg = "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2'><i class='fas fa-check-circle'></i> Program added successfully!</div>";
        } else {
            $status_msg = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4'>Error adding program.</div>";
        }
    }
    
    // UPDATE: Edit Program
    elseif (isset($_POST['edit_program'])) {
        $id = $_POST['id'];
        $program_number = trim($_POST['program_number']);
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);
        $image_url = trim($_POST['image_url']);
        $link_url = trim($_POST['link_url']);
        $status = isset($_POST['status']) ? 1 : 0;
        
        $stmt = $pdo->prepare("UPDATE academy_programs SET program_number=?, title=?, description=?, image_url=?, link_url=?, status=? WHERE id=?");
        if ($stmt->execute([$program_number, $title, $description, $image_url, $link_url, $status, $id])) {
            $status_msg = "<div class='bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2'><i class='fas fa-info-circle'></i> Program updated successfully!</div>";
        } else {
            $status_msg = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4'>Error updating program.</div>";
        }
    }
    
    // DELETE: Remove Program
    elseif (isset($_POST['delete_program'])) {
        $id = $_POST['delete_id'];
        
        $stmt = $pdo->prepare("DELETE FROM academy_programs WHERE id=?");
        if ($stmt->execute([$id])) {
            $status_msg = "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2'><i class='fas fa-trash-alt'></i> Program deleted successfully!</div>";
        } else {
            $status_msg = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4'>Error deleting program.</div>";
        }
    }
}

// ==========================================
// 2. FETCH DATA FOR TABLE
// ==========================================
try {
    $stmt = $pdo->query("SELECT * FROM academy_programs ORDER BY created_at DESC");
    $programs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $programs = [];
    $status_msg = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4'>Database error: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Academy Programs | NGA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: { 
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { primary: '#0B2C4D', ngaBlue: '#4a90e2' } 
                }
            }
        }

        function editProgram(id, prog_num, title, desc, img_url, link_url, status) {
            document.getElementById('form_title').innerText = "Edit Program";
            document.getElementById('program_id').value = id;
            document.getElementById('program_number').value = prog_num;
            document.getElementById('title').value = title;
            document.getElementById('description').value = desc;
            document.getElementById('image_url').value = img_url;
            document.getElementById('link_url').value = link_url;
            
            document.getElementById('status').checked = (status == 1);
            
            document.getElementById('submit_btn').name = "edit_program";
            document.getElementById('submit_btn').innerHTML = "<i class='fas fa-save'></i> Update Program";
            document.getElementById('cancel_btn').classList.remove('hidden');
            
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function resetForm() {
            document.getElementById('form_title').innerText = "Add New Program";
            document.getElementById('program_id').value = "";
            document.getElementById('crud_form').reset();
            
            // Reset status to checked by default for new entries
            document.getElementById('status').checked = true;
            
            document.getElementById('submit_btn').name = "add_program";
            document.getElementById('submit_btn').innerHTML = "<i class='fas fa-plus'></i> Add Program";
            document.getElementById('cancel_btn').classList.add('hidden');
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-primary text-white flex-shrink-0 h-full overflow-y-auto shadow-xl z-20">
        <?php include 'modules/sidebar.php'; ?>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden relative">
        <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-8 shadow-sm flex-shrink-0 z-10">
            <h2 class="text-xl font-bold text-gray-800">Manage Academy Programs</h2>
            <div class="flex items-center gap-3 bg-gray-50 py-1.5 px-4 rounded-full border border-gray-100">
                <div class="w-8 h-8 bg-ngaBlue rounded-full flex items-center justify-center text-white shadow-sm">
                    <i class="fas fa-user text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-gray-700"><?php echo htmlspecialchars($_SESSION['admin']); ?></span>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto grid grid-cols-1 xl:grid-cols-3 gap-8">
                
                <div class="xl:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-0">
                        <div class="flex items-center gap-3 mb-5 border-b pb-3">
                            <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded flex items-center justify-center"><i class="fas fa-edit"></i></div>
                            <h3 id="form_title" class="font-bold text-lg text-gray-800">Add New Program</h3>
                        </div>
                        
                        <?= $status_msg ?>
                        
                        <form id="crud_form" method="POST" action="">
                            <input type="hidden" name="id" id="program_id">
                            
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Program Number</label>
                                <input type="text" name="program_number" id="program_number" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors" placeholder="e.g. PROG-01">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors">
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Description</label>
                                <textarea name="description" id="description" rows="3" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors"></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Image URL</label>
                                <input type="text" name="image_url" id="image_url" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors" placeholder="e.g. assets/img/program1.jpg">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Link URL</label>
                                <input type="text" name="link_url" id="link_url" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors" placeholder="e.g. https://...">
                            </div>

                            <div class="mb-6 flex items-center">
                                <input type="checkbox" name="status" id="status" value="1" checked class="w-4 h-4 text-ngaBlue border-gray-300 rounded focus:ring-ngaBlue">
                                <label for="status" class="ml-2 block text-sm font-semibold text-gray-700 cursor-pointer">Active / Published</label>
                            </div>
                            
                            <div class="flex gap-3">
                                <button type="submit" name="add_program" id="submit_btn" class="flex-1 bg-ngaBlue hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg transition-colors flex justify-center items-center gap-2">
                                    <i class="fas fa-plus"></i> Add Program
                                </button>
                                <button type="button" id="cancel_btn" onclick="resetForm()" class="hidden bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2.5 px-4 rounded-lg transition-colors">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="xl:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                            <h3 class="font-bold text-gray-800"><i class="fas fa-list mr-2 text-gray-400"></i> Existing Programs</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full"><?= count($programs) ?> Total</span>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Program Details</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if(count($programs) > 0): ?>
                                        <?php foreach($programs as $row): ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <?php if(!empty($row['image_url'])): ?>
                                                        <img src="<?= htmlspecialchars($row['image_url']) ?>" alt="img" class="w-10 h-10 rounded object-cover border border-gray-200" onerror="this.src='https://via.placeholder.com/40?text=No+Img'">
                                                    <?php else: ?>
                                                        <div class="w-10 h-10 bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <div class="font-bold text-gray-900"><?= htmlspecialchars($row['title']) ?></div>
                                                        <div class="text-xs font-medium text-ngaBlue mb-1"><?= htmlspecialchars($row['program_number'] ?: 'No #') ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <?php if($row['status'] == 1): ?>
                                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Active</span>
                                                <?php else: ?>
                                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-600">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                
                                                <?php 
                                                    // Escape strings safely for JavaScript parameters
                                                    $js_title = addslashes(htmlspecialchars($row['title'], ENT_QUOTES));
                                                    $js_desc = addslashes(htmlspecialchars($row['description'] ?? '', ENT_QUOTES));
                                                    $js_num = addslashes(htmlspecialchars($row['program_number'] ?? '', ENT_QUOTES));
                                                    $js_img = addslashes(htmlspecialchars($row['image_url'] ?? '', ENT_QUOTES));
                                                    $js_link = addslashes(htmlspecialchars($row['link_url'] ?? '', ENT_QUOTES));
                                                ?>
                                                
                                                <button onclick="editProgram(<?= $row['id'] ?>, '<?= $js_num ?>', '<?= $js_title ?>', '<?= $js_desc ?>', '<?= $js_img ?>', '<?= $js_link ?>', <?= $row['status'] ?>)" class="text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded transition-colors mr-2">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                
                                                <form method="POST" action="" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this program?');">
                                                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                                    <button type="submit" name="delete_program" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded transition-colors">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                                                <div class="text-4xl text-gray-300 mb-3"><i class="fas fa-folder-open"></i></div>
                                                <p>No programs found. Add your first program using the form.</p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</body>
</html>