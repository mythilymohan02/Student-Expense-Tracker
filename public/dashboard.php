<?php

session_start();

if (!isset($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit;
}

require_once "config/db.php";

$total_income = 0;
$total_expense = 0;

$result = $conn->query(
    "SELECT type, SUM(amount) AS total
     FROM transactions
     GROUP BY type"
);

if ($result) {

    while ($row = $result->fetch_assoc()) {

        if ($row["type"] == "income") {
            $total_income = $row["total"];
        }

        if ($row["type"] == "expense") {
            $total_expense = $row["total"];
        }
    }
}

$balance = $total_income - $total_expense;

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Student Expense Tracker</title>

    <link rel="stylesheet" href="css/style.css">
   ```html
<style>
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f2f7ff;
    color: #17365d;
    min-height: 100vh;
}

header, nav {
    background: #ffffff;
    padding: 20px 5%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    box-shadow: 0 3px 15px rgba(20, 75, 140, 0.10);
}

header h1, nav h1 {
    color: #1769d2;
    font-size: 24px;
}

header a, nav a {
    color: #1769d2;
    text-decoration: none;
    font-weight: bold;
    margin-left: 15px;
}

header a:hover, nav a:hover {
    color: #0b4ca3;
}

.container, .dashboard-container, main {
    max-width: 1250px;
    margin: 35px auto;
    padding: 0 25px;
}

h1, h2, h3 {
    color: #173f70;
}

p {
    color: #607792;
}

button, .btn, a.button {
    display: inline-block;
    background: #1769d2;
    color: #ffffff;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    cursor: pointer;
    transition: 0.3s;
}

button:hover, .btn:hover, a.button:hover {
    background: #0b4ca3;
    transform: translateY(-2px);
}

/* Summary cards */
.cards, .summary-cards, .stats-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
    margin: 30px 0;
}

.card, .stat-card, .summary-card {
    background: #ffffff;
    border: 1px solid #dce8f7;
    border-radius: 16px;
    padding: 28px;
    box-shadow: 0 6px 22px rgba(30, 90, 160, 0.08);
    transition: 0.3s;
}

.card:hover, .stat-card:hover, .summary-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(30, 90, 160, 0.13);
}

.card h3, .stat-card h3, .summary-card h3 {
    color: #607792;
    margin-bottom: 12px;
}

.card h2, .stat-card h2, .summary-card h2 {
    color: #1769d2;
    font-size: 27px;
}

.income {
    color: #14804a !important;
}

.expense {
    color: #d9364f !important;
}

.balance {
    color: #1769d2 !important;
}

/* Quick actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 20px;
    margin: 25px 0;
}

.quick-actions a, .action-card {
    display: block;
    background: #ffffff;
    padding: 25px;
    border: 1px solid #dce8f7;
    border-radius: 14px;
    color: #1769d2;
    text-decoration: none;
    box-shadow: 0 5px 18px rgba(30, 90, 160, 0.07);
    transition: 0.3s;
}

.quick-actions a:hover, .action-card:hover {
    background: #e5f0ff;
    transform: translateY(-3px);
}

/* Transactions and reports */
table {
    width: 100%;
    border-collapse: collapse;
    background: #ffffff;
    border-radius: 12px;
    overflow: hidden;
    margin: 20px 0;
    box-shadow: 0 5px 20px rgba(30, 90, 160, 0.07);
}

th {
    background: #1769d2;
    color: #ffffff;
    text-align: left;
    padding: 15px;
}

td {
    padding: 14px;
    border-bottom: 1px solid #e5edf7;
    color: #334f70;
}

tr:hover td {
    background: #f0f6ff;
}

/* Forms and charts */
input, select, textarea {
    width: 100%;
    padding: 12px;
    margin: 8px 0 18px;
    border: 1px solid #cbdcf0;
    border-radius: 8px;
    background: #ffffff;
    color: #17365d;
}

input:focus, select:focus, textarea:focus {
    outline: none;
    border-color: #1769d2;
}

.chart-container, .chart-card {
    background: #ffffff;
    border: 1px solid #dce8f7;
    border-radius: 16px;
    padding: 25px;
    margin: 25px 0;
    box-shadow: 0 5px 20px rgba(30, 90, 160, 0.07);
}

footer {
    text-align: center;
    padding: 25px;
    color: #607792;
}

@media (max-width: 800px) {
    .cards, .summary-cards, .stats-grid,
    .quick-actions {
        grid-template-columns: 1fr;
    }

    header, nav {
        flex-wrap: wrap;
    }

    .container, .dashboard-container, main {
        padding: 0 15px;
    }

    table {
        display: block;
        overflow-x: auto;
    }
}
</style>
```
</head>

<body>

<nav class="navbar">

    <div class="logo">
        Student Expense Tracker
    </div>

    <div class="nav-links">

        <a href="dashboard.php">Dashboard</a>

        <a href="report.php">Report</a>

        <a href="login.php" class="logout">
            Logout
        </a>

    </div>

</nav>


<div class="dashboard-container">

    <div class="welcome-section">

        <div>

            <p class="small-title">
                STUDENT FINANCE
            </p>

            <h1>Dashboard</h1>

            <p>
                Welcome back! Here's your financial overview.
            </p>

        </div>

        <a href="add_transaction.php"
           class="primary-btn">
            + Add Transaction
        </a>

    </div>


    <div class="summary-cards">

        <div class="summary-card income-card">

            <div class="card-icon">₹</div>

            <p>Total Income</p>

            <h2>
                ₹<?php echo number_format($total_income, 2); ?>
            </h2>

        </div>


        <div class="summary-card expense-card">

            <div class="card-icon">−</div>

            <p>Total Expenses</p>

            <h2>
                ₹<?php echo number_format($total_expense, 2); ?>
            </h2>

        </div>


        <div class="summary-card balance-card">

            <div class="card-icon">✓</div>

            <p>Balance</p>

            <h2>
                ₹<?php echo number_format($balance, 2); ?>
            </h2>

        </div>

    </div>


    <div class="quick-actions">

        <h2>Quick Actions</h2>

        <div class="action-grid">

            <a href="add_transaction.php"
               class="action-card">

                <span>＋</span>

                <div>
                    <h3>Add Transaction</h3>
                    <p>Record your income or expense</p>
                </div>

            </a>


            <a href="report.php"
               class="action-card">

                <span>📊</span>

                <div>
                    <h3>View Transactions</h3>
                    <p>View all your transactions</p>
                </div>

            </a>


            <a href="report.php"
               class="action-card">

                <span>📈</span>

                <div>
                    <h3>Monthly Report</h3>
                    <p>Analyze your spending</p>
                </div>

            </a>

        </div>

    </div>

</div>

<script src="js/dashboard.js"></script>

</body>
</html>