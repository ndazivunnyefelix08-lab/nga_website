<?php
session_start();

// Security Check
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

// Database connection
$host = "localhost";
$dbname = "ngarw_spes";
$user = "ngarw_spes"; // change as needed
$pass = "ngarw_spes";     // change as needed

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle deletion
if(isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM donations WHERE id=:id");
    $stmt->execute([':id'=>$id]);
    header("Location: donation.php");
    exit;
}

// Handle CSV export
if(isset($_GET['export']) && $_GET['export'] == 'csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=donations_export_' . date('Y-m-d') . '.csv');

    $output = fopen('php://output', 'w');
    // Add CSV Headers
    fputcsv($output, ['ID','Name','Email','Phone','Amount','Recurring','Donation Date']); 

    // Fetch and write data
    $stmt = $pdo->query("SELECT id,name,email,phone,amount,recurring,donation_date FROM donations ORDER BY donation_date DESC");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// Fetch all donations for display
$stmt = $pdo->query("SELECT * FROM donations ORDER BY donation_date DESC");
$donations = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Donations | NGA Admin</title>

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
            <h2 class="text-xl font-bold text-gray-800 tracking-tight">Donations Management</h2>
            
            <div class="flex items-center gap-3 bg-gray-50 py-1.5 px-4 rounded-full border border-gray-100">
                <div class="w-8 h-8 bg-ngaBlue rounded-full flex items-center justify-center text-white shadow-sm">
                    <i class="fas fa-user text-sm"></i>
                </div>
                <span class="text-sm font-semibold text-gray-700">
                    <?php echo htmlspecialchars($_SESSION['admin']); ?>
                </span>
            </div>
        </header>

        <main class="flex-1 overflow-y-auto p-8">
            <div class="max-w-7xl mx-auto">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
                    
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <div>
                            <h5 class="font-bold text-gray-800 text-lg">Donation Records</h5>
                            <p class="text-sm text-gray-500 mt-0.5">Showing all historical financial contributions.</p>
                        </div>
                        <a href="donation.php?export=csv" class="flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white font-semibold py-2.5 px-5 rounded-xl transition-colors shadow-sm shadow-green-500/20 text-sm">
                            <i class="fas fa-file-csv text-lg"></i>
                            Export CSV
                        </a>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse whitespace-nowrap">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200 text-gray-500 text-xs uppercase tracking-wider">
                                    <th class="px-6 py-4 font-semibold w-16">#</th>
                                    <th class="px-6 py-4 font-semibold">Donor Information</th>
                                    <th class="px-6 py-4 font-semibold">Contact</th>
                                    <th class="px-6 py-4 font-semibold">Amount</th>
                                    <th class="px-6 py-4 font-semibold text-center">Recurring</th>
                                    <th class="px-6 py-4 font-semibold">Date</th>
                                    <th class="px-6 py-4 font-semibold text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <?php if($donations): ?>
                                    <?php $sn = 1; foreach($donations as $d): ?>
                                    <tr class="hover:bg-gray-50/80 transition-colors group">
                                        <td class="px-6 py-4 text-sm font-medium text-gray-500">
                                            <?php echo $sn++; ?>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="font-bold text-gray-800"><?php echo htmlspecialchars($d['name']); ?></div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <div class="text-sm text-gray-600 flex items-center gap-2 mb-1">
                                                <i class="fas fa-envelope text-gray-400 w-3"></i> 
                                                <a href="mailto:<?php echo htmlspecialchars($d['email']); ?>" class="hover:text-blue-600 transition-colors">
                                                    <?php echo htmlspecialchars($d['email']); ?>
                                                </a>
                                            </div>
                                            <div class="text-sm text-gray-600 flex items-center gap-2">
                                                <i class="fas fa-phone-alt text-gray-400 w-3"></i> 
                                                <?php echo htmlspecialchars($d['phone']); ?>
                                            </div>
                                        </td>
                                        
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-sm font-bold bg-green-50 text-green-700 border border-green-100">
                                                $<?php echo number_format($d['amount'], 0); ?>
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider <?php echo (strtolower($d['recurring']) == 'yes' || strtolower($d['recurring']) == 'monthly') ? 'bg-blue-100 text-blue-700' : 'bg-gray-100 text-gray-600'; ?>">
                                                <?php echo htmlspecialchars($d['recurring']); ?>
                                            </span>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-sm text-gray-600">
                                            <?php echo date('M d, Y', strtotime($d['donation_date'])); ?>
                                            <span class="text-xs text-gray-400 block mt-0.5"><?php echo date('h:i A', strtotime($d['donation_date'])); ?></span>
                                        </td>
                                        
                                        <td class="px-6 py-4 text-right">
                                            <a href="donation.php?delete=<?php echo $d['id']; ?>" 
                                               onclick="return confirm('Are you sure you want to permanently delete this donation record?');" 
                                               class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors tooltip opacity-0 group-hover:opacity-100" title="Delete Record">
                                                <i class="fas fa-trash-alt text-sm"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-gray-100 mb-4">
                                                <i class="fas fa-box-open text-2xl text-gray-400"></i>
                                            </div>
                                            <h5 class="text-gray-900 font-semibold mb-1">No Donations Yet</h5>
                                            <p class="text-gray-500 text-sm">There are currently no donation records in the database.</p>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

</body>
</html>