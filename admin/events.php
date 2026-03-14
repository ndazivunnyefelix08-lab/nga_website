<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
include "../config/db.php";

// Check admin login
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// --- NEW: Handle Display Toggle via Checkbox ---
if (isset($_GET['toggle_id']) && isset($_GET['status'])) {
    $id = intval($_GET['toggle_id']);
    $status = ($_GET['status'] == '1') ? 'yes' : 'no';

    if ($status == 'yes') {
        // Check how many are currently marked 'yes'
        $check_sql = "SELECT COUNT(*) as total FROM events WHERE is_display = 'yes'";
        $check_res = mysqli_query($conn, $check_sql);
        $count = mysqli_fetch_assoc($check_res)['total'];

        if ($count >= 3) {
            $_SESSION['msg_error'] = "You can only select a maximum of 3 events for display!";
            header("Location: events.php");
            exit;
        }
    }

    $update_stmt = mysqli_prepare($conn, "UPDATE events SET is_display = ? WHERE id = ?");
    mysqli_stmt_bind_param($update_stmt, "si", $status, $id);
    mysqli_stmt_execute($update_stmt);
    mysqli_stmt_close($update_stmt);
    
    header("Location: events.php");
    exit;
}

// Delete event
if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    if ($del_id > 0) {
        $stmt = mysqli_prepare($conn, "DELETE FROM events WHERE id=?");
        mysqli_stmt_bind_param($stmt, "i", $del_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: events.php");
        exit;
    }
}

// Add or update event
if (isset($_POST['save'])) {
    $title = trim($_POST['title']);
    $body = $_POST['body'];
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;

    $uploaded_image = null;
    $upload_folder = "../uploads/events/";
    if (!is_dir($upload_folder)) { mkdir($upload_folder, 0777, true); }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $file_name = time() . "_" . basename($_FILES['image']['name']);
        $target = $upload_folder . $file_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $uploaded_image = "uploads/events/" . $file_name;
        }
    }

    if ($id > 0) {
        if ($uploaded_image) {
            $stmt = mysqli_prepare($conn, "UPDATE events SET title=?, body=?, image=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "sssi", $title, $body, $uploaded_image, $id);
        } else {
            $stmt = mysqli_prepare($conn, "UPDATE events SET title=?, body=? WHERE id=?");
            mysqli_stmt_bind_param($stmt, "ssi", $title, $body, $id);
        }
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO events (title, body, image, created_at) VALUES (?, ?, ?, NOW())");
        mysqli_stmt_bind_param($stmt, "sss", $title, $body, $uploaded_image);
    }
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: events.php");
    exit;
}

// Fetch all events
$events = [];
$result = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC");
while ($row = mysqli_fetch_assoc($result)) { $events[] = $row; }

// Fetch event for editing
$edit_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
$edit_event = ['id' => 0, 'title' => '', 'body' => '', 'image' => ''];
if ($edit_id > 0) {
    $stmt = mysqli_prepare($conn, "SELECT id, title, body, image FROM events WHERE id=?");
    mysqli_stmt_bind_param($stmt, "i", $edit_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $edit_event['id'], $edit_event['title'], $edit_event['body'], $edit_event['image']);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Events | NGA Admin</title>

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
        
        <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-8 shadow-sm z-10 flex-shrink-0">
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">Events Management</h2>
            
            <div class="flex items-center gap-3 bg-gray-50 py-1.5 px-4 rounded-full border border-gray-100">
                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center text-white shadow-sm">
                    <i class="fas fa-user text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-gray-700">
                    <?php echo htmlspecialchars($_SESSION['admin']); ?>
                </span>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            
            <?php if (isset($_SESSION['msg_error'])): ?>
                <div class="max-w-7xl mx-auto mb-6 bg-red-50 border border-red-200 text-red-600 px-6 py-4 rounded-xl flex justify-between items-center shadow-sm">
                    <div class="flex items-center gap-3 font-medium">
                        <i class="fas fa-exclamation-circle text-xl"></i> 
                        <?php echo $_SESSION['msg_error']; unset($_SESSION['msg_error']); ?>
                    </div>
                    <button type="button" onclick="this.parentElement.style.display='none'" class="text-red-400 hover:text-red-600 transition-colors">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>
            <?php endif; ?>

            <div class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-8">
                
                <div class="w-full lg:w-1/3">
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-0 overflow-hidden">
                        <div class="<?php echo $edit_id ? 'bg-orange-500' : 'bg-blue-600'; ?> px-6 py-4 flex items-center gap-2">
                            <i class="fas <?php echo $edit_id ? 'fa-edit' : 'fa-plus-circle'; ?> text-white"></i>
                            <h3 class="text-white font-semibold"><?php echo $edit_id ? "Edit Event" : "Add New Event"; ?></h3>
                        </div>
                        <div class="p-6">
                            <form method="post" enctype="multipart/form-data" class="space-y-4">
                                <input type="hidden" name="id" value="<?php echo $edit_event['id']; ?>">
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Title</label>
                                    <input type="text" name="title" value="<?php echo htmlspecialchars($edit_event['title']); ?>" required
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Body (HTML allowed)</label>
                                    <textarea name="body" rows="6" required
                                        class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:bg-white transition-all text-sm resize-none"><?php echo $edit_event['body']; ?></textarea>
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Header Image</label>
                                    <input type="file" name="image" accept="image/*"
                                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all cursor-pointer border border-gray-200 rounded-xl p-1 bg-gray-50">
                                    
                                    <?php if ($edit_event['image']): ?>
                                        <div class="mt-3 relative inline-block">
                                            <span class="absolute top-1 left-1 bg-black/50 text-white text-[10px] px-2 py-1 rounded-md backdrop-blur-sm">Current</span>
                                            <img src="../<?php echo $edit_event['image']; ?>" class="rounded-lg object-cover w-32 h-20 shadow-sm border border-gray-200">
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="pt-2">
                                    <button type="submit" name="save" class="w-full <?php echo $edit_id ? 'bg-orange-500 hover:bg-orange-600 shadow-orange-500/20' : 'bg-blue-600 hover:bg-blue-700 shadow-blue-500/20'; ?> text-white font-bold py-3 rounded-xl transition-colors shadow-md flex items-center justify-center gap-2">
                                        <i class="fas fa-save"></i> Save Event
                                    </button>
                                    
                                    <?php if ($edit_id): ?>
                                        <a href="events.php" class="block w-full text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 rounded-xl mt-3 transition-colors">
                                            Cancel Edit
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
                            <h5 class="font-bold text-gray-800 text-lg">All Events</h5>
                            <span class="bg-green-100 text-green-700 text-xs font-bold px-3 py-1 rounded-full border border-green-200">
                                Max 3 for Display on Home Page
                            </span>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                                        <th class="px-6 py-4 font-semibold">ID</th>
                                        <th class="px-6 py-4 font-semibold text-center">Display</th>
                                        <th class="px-6 py-4 font-semibold">Image</th>
                                        <th class="px-6 py-4 font-semibold">Title</th>
                                        <th class="px-6 py-4 font-semibold text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100">
                                    <?php if (empty($events)): ?>
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-gray-500 font-medium">No events found. Start by adding one!</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($events as $e): ?>
                                            <tr class="hover:bg-gray-50/50 transition-colors group">
                                                <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                                    #<?php echo $e['id']; ?>
                                                </td>
                                                
                                                <td class="px-6 py-4 align-middle text-center">
                                                    <label class="relative inline-flex items-center cursor-pointer">
                                                        <input type="checkbox" class="sr-only peer" 
                                                               <?php echo ($e['is_display'] == 'yes') ? 'checked' : ''; ?>
                                                               onclick="toggleDisplay(<?php echo $e['id']; ?>, this.checked)">
                                                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-2 peer-focus:ring-blue-300 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500"></div>
                                                    </label>
                                                </td>
                                                
                                                <td class="px-6 py-4">
                                                    <?php if (!empty($e['image'])): ?>
                                                        <img src="../<?php echo $e['image']; ?>" class="w-16 h-12 rounded-lg object-cover border border-gray-200 shadow-sm">
                                                    <?php else: ?>
                                                        <div class="w-16 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400 text-xs">
                                                            No Img
                                                        </div>
                                                    <?php endif; ?>
                                                </td>
                                                
                                                <td class="px-6 py-4 text-sm font-semibold text-gray-800">
                                                    <?php echo htmlspecialchars(mb_substr($e['title'], 0, 45)) . (mb_strlen($e['title']) > 45 ? '...' : ''); ?>
                                                </td>
                                                
                                                <td class="px-6 py-4 text-right">
                                                    <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                                        <a href="events.php?edit=<?php echo $e['id']; ?>" class="w-8 h-8 rounded-lg bg-orange-50 text-orange-500 hover:bg-orange-500 hover:text-white flex items-center justify-center transition-colors tooltip" title="Edit">
                                                            <i class="fas fa-edit text-sm"></i>
                                                        </a>
                                                        <a href="events.php?delete=<?php echo $e['id']; ?>" onclick="return confirm('Are you sure you want to delete this event?');" class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white flex items-center justify-center transition-colors tooltip" title="Delete">
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

    <script>
        // Javascript to handle the toggle redirect seamlessly
        function toggleDisplay(id, isChecked) {
            const status = isChecked ? 1 : 0;
            window.location.href = `events.php?toggle_id=${id}&status=${status}`;
        }
    </script>
</body>
</html>