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
    
    // CREATE: Add New Blog Post
    if (isset($_POST['add_blog'])) {
        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $post_date = trim($_POST['post_date']);
        $image_path = trim($_POST['image_path']);
        $content = trim($_POST['content']);
        $status = isset($_POST['status']) ? 1 : 0;
        
        $stmt = $pdo->prepare("INSERT INTO academy_blogs (title, content, image_path, author, post_date, status) VALUES (?, ?, ?, ?, ?, ?)");
        if ($stmt->execute([$title, $content, $image_path, $author, $post_date, $status])) {
            $status_msg = "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2'><i class='fas fa-check-circle'></i> Blog post added successfully!</div>";
        } else {
            $status_msg = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4'>Error adding blog post.</div>";
        }
    }
    
    // UPDATE: Edit Blog Post
    elseif (isset($_POST['edit_blog'])) {
        $id = $_POST['id'];
        $title = trim($_POST['title']);
        $author = trim($_POST['author']);
        $post_date = trim($_POST['post_date']);
        $image_path = trim($_POST['image_path']);
        $content = trim($_POST['content']);
        $status = isset($_POST['status']) ? 1 : 0;
        
        $stmt = $pdo->prepare("UPDATE academy_blogs SET title=?, content=?, image_path=?, author=?, post_date=?, status=? WHERE id=?");
        if ($stmt->execute([$title, $content, $image_path, $author, $post_date, $status, $id])) {
            $status_msg = "<div class='bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2'><i class='fas fa-info-circle'></i> Blog post updated successfully!</div>";
        } else {
            $status_msg = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4'>Error updating blog post.</div>";
        }
    }
    
    // DELETE: Remove Blog Post
    elseif (isset($_POST['delete_blog'])) {
        $id = $_POST['delete_id'];
        
        $stmt = $pdo->prepare("DELETE FROM academy_blogs WHERE id=?");
        if ($stmt->execute([$id])) {
            $status_msg = "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-4 flex items-center gap-2'><i class='fas fa-trash-alt'></i> Blog post deleted successfully!</div>";
        } else {
            $status_msg = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4'>Error deleting blog post.</div>";
        }
    }
}

// ==========================================
// 2. FETCH DATA FOR TABLE
// ==========================================
try {
    $stmt = $pdo->query("SELECT * FROM academy_blogs ORDER BY post_date DESC, id DESC");
    $blogs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $blogs = [];
    $status_msg = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4'>Database error: " . $e->getMessage() . "</div>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Academy Blogs | NGA</title>
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
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex h-screen overflow-hidden">

    <aside class="w-64 bg-primary text-white flex-shrink-0 h-full overflow-y-auto shadow-xl z-20">
        <?php include 'modules/sidebar.php'; ?>
    </aside>

    <div class="flex-1 flex flex-col h-full overflow-hidden relative">
        <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-8 shadow-sm flex-shrink-0 z-10">
            <h2 class="text-xl font-bold text-gray-800">Manage Academy Blogs</h2>
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
                            <div class="w-8 h-8 bg-blue-50 text-blue-600 rounded flex items-center justify-center"><i class="fas fa-pen-nib"></i></div>
                            <h3 id="form_title" class="font-bold text-lg text-gray-800">Add New Blog Post</h3>
                        </div>
                        
                        <?= $status_msg ?>
                        
                        <form id="crud_form" method="POST" action="">
                            <input type="hidden" name="id" id="blog_id">

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" id="title" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors">
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Author</label>
                                    <input type="text" name="author" id="author" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors" placeholder="e.g. John Doe">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-1">Post Date</label>
                                    <input type="date" name="post_date" id="post_date" value="<?= date('Y-m-d') ?>" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Image Path</label>
                                <input type="text" name="image_path" id="image_path" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors" placeholder="e.g. assets/img/blog1.jpg">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Content</label>
                                <textarea name="content" id="content" rows="6" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-1 focus:ring-ngaBlue focus:outline-none transition-colors" placeholder="Write your blog content here..."></textarea>
                            </div>

                            <div class="mb-6 flex items-center">
                                <input type="checkbox" name="status" id="status" value="1" checked class="w-4 h-4 text-ngaBlue border-gray-300 rounded focus:ring-ngaBlue">
                                <label for="status" class="ml-2 block text-sm font-semibold text-gray-700 cursor-pointer">Published</label>
                            </div>
                            
                            <div class="flex gap-3">
                                <button type="submit" name="add_blog" id="submit_btn" class="flex-1 bg-ngaBlue hover:bg-blue-600 text-white font-bold py-2.5 px-4 rounded-lg transition-colors flex justify-center items-center gap-2">
                                    <i class="fas fa-plus"></i> Add Post
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
                            <h3 class="font-bold text-gray-800"><i class="fas fa-list mr-2 text-gray-400"></i> Published Blogs</h3>
                            <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full"><?= count($blogs) ?> Total</span>
                        </div>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Blog Details</th>
                                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Author & Date</th>
                                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php if(count($blogs) > 0): ?>
                                        <?php foreach($blogs as $row): ?>
                                        <tr class="hover:bg-gray-50 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <?php if(!empty($row['image_path'])): ?>
                                                        <img src="<?= htmlspecialchars($row['image_path']) ?>" alt="img" class="w-12 h-12 rounded object-cover border border-gray-200" onerror="this.src='https://via.placeholder.com/48?text=Img'">
                                                    <?php else: ?>
                                                        <div class="w-12 h-12 bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-gray-400"><i class="fas fa-image"></i></div>
                                                    <?php endif; ?>
                                                    
                                                    <div class="max-w-xs">
                                                        <div class="font-bold text-gray-900 truncate"><?= htmlspecialchars($row['title']) ?></div>
                                                        <div class="text-xs text-gray-500 mt-1 flex items-center gap-2">
                                                            <?php if($row['status'] == 1): ?>
                                                                <span class="w-2 h-2 rounded-full bg-green-500 inline-block"></span> Published
                                                            <?php else: ?>
                                                                <span class="w-2 h-2 rounded-full bg-gray-400 inline-block"></span> Draft
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm font-medium text-gray-900"><i class="fas fa-user-edit text-gray-400 mr-1"></i> <?= htmlspecialchars($row['author'] ?: 'Admin') ?></div>
                                                <div class="text-xs text-gray-500 mt-1"><i class="far fa-calendar-alt text-gray-400 mr-1"></i> <?= htmlspecialchars($row['post_date']) ?></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                
                                                <button type="button" 
                                                    class="edit-btn text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 px-3 py-1.5 rounded transition-colors mr-2"
                                                    data-id="<?= $row['id'] ?>"
                                                    data-title="<?= htmlspecialchars($row['title'], ENT_QUOTES) ?>"
                                                    data-author="<?= htmlspecialchars($row['author'], ENT_QUOTES) ?>"
                                                    data-date="<?= htmlspecialchars($row['post_date'], ENT_QUOTES) ?>"
                                                    data-image="<?= htmlspecialchars($row['image_path'], ENT_QUOTES) ?>"
                                                    data-status="<?= $row['status'] ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                
                                                <textarea id="content_<?= $row['id'] ?>" class="hidden"><?= htmlspecialchars($row['content']) ?></textarea>

                                                <form method="POST" action="" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                                    <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
                                                    <button type="submit" name="delete_blog" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded transition-colors">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                                
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="3" class="px-6 py-10 text-center text-gray-500">
                                                <div class="text-4xl text-gray-300 mb-3"><i class="fas fa-newspaper"></i></div>
                                                <p>No blog posts found. Write your first post using the form.</p>
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

    <script>
        // Setup Event Listeners for Edit Buttons
        document.querySelectorAll('.edit-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Get data from attributes
                const id = this.getAttribute('data-id');
                const title = this.getAttribute('data-title');
                const author = this.getAttribute('data-author');
                const postDate = this.getAttribute('data-date');
                const imagePath = this.getAttribute('data-image');
                const status = this.getAttribute('data-status');
                
                // Get content from the hidden textarea (safest way for line breaks/quotes)
                const content = document.getElementById('content_' + id).value;

                // Populate Form
                document.getElementById('form_title').innerText = "Edit Blog Post";
                document.getElementById('blog_id').value = id;
                document.getElementById('title').value = title;
                document.getElementById('author').value = author;
                document.getElementById('post_date').value = postDate;
                document.getElementById('image_path').value = imagePath;
                document.getElementById('content').value = content;
                document.getElementById('status').checked = (status == 1);
                
                // Update Buttons
                const submitBtn = document.getElementById('submit_btn');
                submitBtn.name = "edit_blog";
                submitBtn.innerHTML = "<i class='fas fa-save'></i> Update Post";
                document.getElementById('cancel_btn').classList.remove('hidden');
                
                // Smooth Scroll to top
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });

        // Reset Form Function
        function resetForm() {
            document.getElementById('form_title').innerText = "Add New Blog Post";
            document.getElementById('blog_id').value = "";
            document.getElementById('crud_form').reset();
            
            // Re-check status checkbox and set today's date
            document.getElementById('status').checked = true;
            document.getElementById('post_date').value = new Date().toISOString().split('T')[0];
            
            const submitBtn = document.getElementById('submit_btn');
            submitBtn.name = "add_blog";
            submitBtn.innerHTML = "<i class='fas fa-plus'></i> Add Post";
            document.getElementById('cancel_btn').classList.add('hidden');
        }
    </script>
</body>
</html>