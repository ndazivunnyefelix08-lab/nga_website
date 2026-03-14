<?php
session_start();

// Database connection
$conn = mysqli_connect("localhost", "ngarw_spes", "ngarw_spes", "ngarw_spes");
if (!$conn) die("Connection failed");

/* Check if we are editing */
$editMode = false;
$student = [
    'id' => '',
    'full_name' => '',
    'summary' => '',
    'photo' => ''
];

if (isset($_GET['edit'])) {
    $editMode = true;
    $id = intval($_GET['edit']);
    $res = mysqli_query($conn, "SELECT * FROM students_history WHERE id=$id");
    if($res && mysqli_num_rows($res) > 0) {
        $student = mysqli_fetch_assoc($res);
    }
}

/* Fetch all students */
$result = mysqli_query($conn, "SELECT * FROM students_history ORDER BY id DESC");
$students = [];
if($result) {
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Student Stories | NGA Admin</title>

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
        <?php include '../admin/modules/sidebar.php'; ?>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden relative">
        
        <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10 flex-shrink-0">
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">Student Stories Management</h2>
            
            <div class="flex items-center gap-3 bg-gray-50 py-1.5 px-4 rounded-full border border-gray-100">
                <div class="w-8 h-8 bg-teal-500 rounded-full flex items-center justify-center text-white shadow-sm">
                    <i class="fas fa-user-graduate text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-gray-700">
                    <?php echo htmlspecialchars($_SESSION['admin'] ?? 'Admin'); ?>
                </span>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            
            <?php if (isset($_GET['success'])): ?>
                <div class="max-w-7xl mx-auto mb-6 bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-3 font-medium">
                        <i class="fas fa-check-circle text-xl"></i> 
                        Student history <?= $editMode ? 'updated' : 'added'; ?> successfully!
                    </div>
                    <button type="button" onclick="this.parentElement.style.display='none'" class="text-green-500 hover:text-green-700 transition-colors">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            <?php endif; ?>

            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
                
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-0 overflow-hidden">
                        
                        <div class="<?php echo $editMode ? 'bg-orange-500' : 'bg-teal-600'; ?> px-6 py-4 flex items-center gap-2">
                            <i class="fas <?php echo $editMode ? 'fa-user-edit' : 'fa-book-open'; ?> text-white"></i>
                            <h3 class="text-white font-semibold">
                                <?= $editMode ? 'Edit Student History' : 'NGA Student Stories'; ?>
                            </h3>
                        </div>
                        
                        <div class="p-6">
                            <form action="save_history.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                                <?php if($editMode): ?>
                                    <input type="hidden" name="id" value="<?= $student['id']; ?>">
                                <?php endif; ?>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Student Full Name</label>
                                    <input type="text" name="full_name" required value="<?= htmlspecialchars($student['full_name']); ?>" placeholder="Enter full name"
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all text-sm">
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Story Summary</label>
                                    <textarea name="summary" rows="5" required placeholder="Write the student's story here..."
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:bg-white transition-all text-sm resize-none"><?= htmlspecialchars($student['summary']); ?></textarea>
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Student Photo</label>
                                    <input type="file" name="photo" accept="image/*" <?php echo !$editMode ? 'required' : ''; ?>
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100 transition-all cursor-pointer border border-gray-200 rounded-xl p-1 bg-gray-50">
                                    
                                    <?php if($editMode && $student['photo']): ?>
                                        <div class="mt-3 relative inline-block">
                                            <span class="absolute top-1 left-1 bg-black/50 text-white text-[10px] px-2 py-1 rounded-md backdrop-blur-sm">Current</span>
                                            <img src="../uploads/<?= $student['photo']; ?>" class="w-20 h-20 rounded-full object-cover border-2 border-gray-200 shadow-sm">
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="pt-4">
                                    <button type="submit" class="w-full <?php echo $editMode ? 'bg-orange-500 hover:bg-orange-600 shadow-orange-500/20' : 'bg-teal-600 hover:bg-teal-700 shadow-teal-500/20'; ?> text-white font-bold py-3 rounded-xl transition-colors shadow-md flex items-center justify-center gap-2 text-sm">
                                        <i class="fas fa-save"></i> <?= $editMode ? 'Update History' : 'Save Story'; ?>
                                    </button>

                                    <?php if($editMode): ?>
                                        <a href="?" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl mt-3 transition-colors text-sm">
                                            Cancel
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                        
                        <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <h5 class="font-bold text-gray-800 text-lg">Student Records</h5>
                            <span class="bg-teal-100 text-teal-700 text-xs font-bold px-3 py-1 rounded-full border border-teal-200">
                                <?= count($students) ?> Total Stories
                            </span>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                                        <th class="px-6 py-4 font-semibold w-16">#</th>
                                        <th class="px-6 py-4 font-semibold">Photo</th>
                                        <th class="px-6 py-4 font-semibold">Full Name</th>
                                        <th class="px-6 py-4 font-semibold">Summary</th>
                                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php if(count($students) == 0): ?>
                                        <tr>
                                            <td colspan="5" class="px-6 py-12 text-center">
                                                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                                                    <i class="fas fa-book-open text-2xl text-gray-400"></i>
                                                </div>
                                                <h5 class="text-gray-900 font-semibold mb-1">No Stories Yet</h5>
                                                <p class="text-gray-500 text-sm">Start by adding a new student story using the form.</p>
                                            </td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach($students as $s): ?>
                                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                                <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                                    <?= $s['id']; ?>
                                                </td>
                                                
                                                <td class="px-6 py-4">
                                                    <?php if (!empty($s['photo'])): ?>
                                                        <img src="../uploads/<?= $s['photo']; ?>" class="w-12 h-12 rounded-full object-cover border border-gray-200 shadow-sm">
                                                    <?php else: ?>
                                                        <div class="w-12 h-12 rounded-full bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400">
                                                            <i class="fas fa-user"></i>
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <td class="px-6 py-4 text-sm font-bold text-gray-800">
                                                    <?= htmlspecialchars($s['full_name']); ?>
                                                </td>
                                                
                                                <td class="px-6 py-4 text-sm text-gray-600">
                                                    <?= htmlspecialchars(mb_strimwidth($s['summary'], 0, 60, "...")); ?>
                                                </td>
                                                
                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <a href="?edit=<?= $s['id']; ?>" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 hover:bg-orange-500 hover:text-white flex items-center justify-center transition-colors tooltip" title="Edit">
                                                            <i class="fas fa-edit text-sm"></i>
                                                        </a>
                                                        <a href="delete_history.php?id=<?= $s['id']; ?>" onclick="return confirm('Are you sure you want to delete this history?');" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors tooltip" title="Delete">
                                                            <i class="fas fa-trash-alt text-sm"></i>
                                                        </a>
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

</body>
</html>