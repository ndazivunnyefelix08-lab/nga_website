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

// ==========================================
// 1. HANDLE BULK EMAIL SUBMISSION
// ==========================================
$email_status = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_bulk_email'])) {
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    if (!empty($subject) && !empty($message)) {
        $stmt_all = $pdo->query("SELECT email FROM newsletter_subscribers");
        $all_emails = $stmt_all->fetchAll(PDO::FETCH_COLUMN);

        if (count($all_emails) > 0) {
            $sender_email = "info@nga.ac.rw";
            $to = $sender_email; 
            $bcc = implode(',', $all_emails); 

            $headers  = "From: New Generation Academy <$sender_email>\r\n";
            $headers .= "Reply-To: $sender_email\r\n";
            $headers .= "Bcc: $bcc\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

            $html_message = "
            <html>
            <body style='font-family: Arial, sans-serif; color: #333; line-height: 1.6;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                    " . nl2br(htmlspecialchars($message)) . "
                    <br><br>
                    <hr style='border: none; border-top: 1px solid #eee;'>
                    <p style='font-size: 12px; color: #777;'>You are receiving this because you subscribed to the New Generation Academy newsletter.</p>
                </div>
            </body>
            </html>";

            if (mail($to, $subject, $html_message, $headers)) {
                $email_status = "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2'><i class='fas fa-check-circle'></i> Email successfully sent to " . count($all_emails) . " subscribers.</div>";
            } else {
                $email_status = "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2'><i class='fas fa-exclamation-triangle'></i> Failed to send emails.</div>";
            }
        } else {
            $email_status = "<div class='bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2'><i class='fas fa-info-circle'></i> No subscribers found.</div>";
        }
    }
}

// Fetch subscribers
$stmt_subs = $pdo->query("SELECT * FROM newsletter_subscribers ORDER BY subscribed_at DESC LIMIT 10");
$subscribers = $stmt_subs->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | NGA</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        primary: '#0B2C4D',
                        ngaBlue: '#4a90e2',
                        ngaAccent: '#F04B23'
                    }
                }
            }
        }

        // Toggle Function for Mobile Menu
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased flex h-screen overflow-hidden relative">

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-primary text-white transform -translate-x-full transition-transform duration-300 ease-in-out md:translate-x-0 md:static md:inset-0 h-full overflow-y-auto shadow-xl flex-shrink-0">
        <?php include 'modules/sidebar.php'; ?>
    </aside>

    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-30 hidden md:hidden" onclick="toggleSidebar()"></div>

    <div class="flex-1 flex flex-col h-full overflow-hidden">
        
        <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-4 md:px-8 shadow-sm z-10 flex-shrink-0">
            <div class="flex items-center gap-3">
                <button onclick="toggleSidebar()" class="md:hidden p-2 text-gray-600 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight">Dashboard Overview</h2>
            </div>
            
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-3 bg-gray-50 py-1.5 px-3 md:px-4 rounded-full border border-gray-100">
                    <div class="w-8 h-8 bg-ngaBlue rounded-full flex items-center justify-center text-white shadow-sm">
                        <i class="fas fa-user text-sm"></i>
                    </div>
                    <span class="hidden sm:inline text-sm font-semibold text-gray-700">
                        <?php echo htmlspecialchars($_SESSION['admin']); ?>
                    </span>
                </div>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-4 md:p-8">
            <div class="max-w-7xl mx-auto">
                
                <h3 class="text-gray-500 text-xs md:text-sm font-semibold uppercase tracking-wider mb-5">Quick Access Modules</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5 mb-10">
                    <a href="about_sections.php" class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform"><i class="fas fa-info-circle text-lg"></i></div>
                            <h5 class="text-base font-bold text-gray-800 group-hover:text-blue-600">About Us</h5>
                        </div>
                        <div class="mt-auto w-full text-center bg-blue-50/50 group-hover:bg-blue-600 group-hover:text-white text-blue-600 font-semibold py-2 rounded-lg text-sm">Manage About</div>
                    </a>
                    
                    <a href="events.php" class="bg-white rounded-xl p-5 shadow-sm border border-gray-100 hover:shadow-lg transition-all duration-300 flex flex-col group">
                        <div class="flex items-center gap-4 mb-5">
                            <div class="w-10 h-10 bg-green-50 text-green-600 rounded-lg flex items-center justify-center group-hover:scale-110 transition-transform"><i class="fas fa-calendar-alt text-lg"></i></div>
                            <h5 class="text-base font-bold text-gray-800 group-hover:text-green-600">News & Events</h5>
                        </div>
                        <div class="mt-auto w-full text-center bg-green-50/50 group-hover:bg-green-600 group-hover:text-white text-green-600 font-semibold py-2 rounded-lg text-sm">Manage Events</div>
                    </a>

                    </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-8">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <h3 class="font-bold text-gray-800">Send Broadcast Email</h3>
                    </div>
                    
                    <div class="p-6">
                        <?= $email_status ?> 
                        <form method="POST" action="">
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="subject">Email Subject</label>
                                <input type="text" name="subject" id="subject" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-ngaBlue focus:ring-1 focus:ring-ngaBlue transition-colors" required>
                            </div>
                            
                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="message">Message Body</label>
                                <textarea name="message" id="message" rows="6" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:border-ngaBlue focus:ring-1 focus:ring-ngaBlue transition-colors" required></textarea>
                            </div>
                            
                            <button type="submit" name="send_bulk_email" class="w-full sm:w-auto bg-ngaBlue hover:bg-blue-600 text-white font-bold py-2.5 px-6 rounded-lg transition-all duration-200 flex items-center justify-center gap-2 shadow-sm">
                                <i class="fas fa-paper-plane"></i> Send to All Subscribers
                            </button>
                        </form>
                    </div>
                </div>

               <div class="mt-8">
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <h3 class="text-gray-500 text-xs md:text-sm font-semibold uppercase tracking-wider">Recent Subscribers</h3>
            <button onclick="toggleSubscribers()" id="subToggleBtn" class="text-ngaBlue hover:text-blue-700 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded-md text-xs font-bold flex items-center gap-2 transition-colors">
                <span id="toggleText">Show List</span>
                <i id="toggleIcon" class="fas fa-chevron-down transition-transform duration-300"></i>
            </button>
        </div>
        <span class="text-[10px] md:text-xs text-gray-400 font-medium bg-gray-200 px-2 py-1 rounded">Latest 10</span>
    </div>
    
    <div id="subscribersList" class="hidden bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden transition-all duration-300">
        <div class="overflow-x-auto"> 
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Name</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php if(count($subscribers) > 0): ?>
                        <?php foreach($subscribers as $sub): ?>
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= htmlspecialchars($sub['name']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= htmlspecialchars($sub['email']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= date('M d, Y', strtotime($sub['subscribed_at'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="3" class="px-6 py-8 text-center text-gray-500">No subscribers found yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function toggleSubscribers() {
    const list = document.getElementById('subscribersList');
    const text = document.getElementById('toggleText');
    const icon = document.getElementById('toggleIcon');
    
    // Toggle the 'hidden' class
    const isHidden = list.classList.toggle('hidden');
    
    // Update button text and rotate icon
    if (isHidden) {
        text.innerText = 'Show List';
        icon.style.transform = 'rotate(0deg)';
    } else {
        text.innerText = 'Hide List';
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>

</body>
</html>