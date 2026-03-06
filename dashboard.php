<?php
session_start();

// Agar login nahi hua ho to redirect
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Enhanced Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />


  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* Sidebar styling */
    .sidebar {
      background: #2c3e50;
      color: #ecf0f1;
      height: 100vh;
      padding: 30px 20px;
      position: fixed;
      width: 220px;
      transition: all 0.3s ease;
      overflow-y: auto;
    }

    .sidebar.collapsed {
      width: 70px;
    }

    .sidebar h4 {
      font-size: 28px;
      margin-bottom: 40px;
      font-weight: 700;
      white-space: nowrap;
    }

    .sidebar a {
      color: #bdc3c7;
      display: flex;
      align-items: center;
      padding: 12px 15px;
      font-size: 16px;
      text-decoration: none;
      border-radius: 8px;
      transition: background 0.3s, color 0.3s;
      white-space: nowrap;
    }

    .sidebar a i {
      margin-right: 12px;
      min-width: 20px;
      text-align: center;
    }

    .sidebar a:hover {
      background: #34495e;
      color: #fff;
    }

    .sidebar.collapsed a span {
      display: none;
    }

    /* Main content shifts on sidebar toggle */
    .main-content {
      margin-left: 220px;
      padding: 30px;
      transition: margin-left 0.3s ease;
    }

    .main-content.expanded {
      margin-left: 70px;
    }
    
    /* Heading */
    .heading{
      margin: 10px;
      padding: 10px;
      border-radius: 8px;
      background-color: #cde1f5ff;
    } 

    .heading h1{
      font-family: 'Times New Roman';
      font-weight: bold;
      color: #2c3e50;
    }

    /* Navbar area */
    .navbar-custom {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 30px;
    }

    .toggle-btn {
      font-size: 24px;
      cursor: pointer;
      color: #2c3e50;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 15px;
    }

    /* Info section styles */
    .info-section {
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.07);
      padding: 30px;
      display: flex;
      align-items: center;
      gap: 20px;
      margin-bottom: 40px;
    }

    .info-content h5 {
      color: #0984e3;
      margin-bottom: 15px;
      font-weight: 700;
    }

    .info-content ul {
      padding-left: 20px;
      list-style-type: disc;
      font-size: 16px;
      color: #2d3436;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        left: -220px;
        top: 0;
        z-index: 1030;
      }

      .sidebar.active {
        left: 0;
      }

      .sidebar.collapsed {
        width: 220px;
      }

      .main-content,
      .main-content.expanded {
        margin-left: 0;
        padding: 15px;
      }

      .toggle-btn {
        display: block;
      }
    }
  </style>
</head>

<body>
  <div class="sidebar" id="sidebar">
    <h4 class="text-center">User Panel</h4>
    <a href="dashboard.php"><i class="fa-solid fa-gauge"></i><span> Dashboard</span></a>
    <a href="#" onclick="loadPage('view_profile.php')"><i class="fa-solid fa-user"></i><span> My Profile</span></a>
    <!-- <a href="#" onclick="loadPage('health_logs_form.php')"><i class="fa-solid fa-notes-medical"></i><span> Health Records</span></a> -->
    <a href="#" onclick="loadPage('view_health.php')"><i class="fa-solid fa-notes-medical"></i><span> Health Records</span></a>
    <a href="#" onclick="loadPage('view_diet_plan.php')"><i class="fa-solid fa-utensils"></i><span> Diet Plan</span></a>

    <!-- <a href="#" onclick="loadPage('report.php')"><i class="fa-solid fa-chart-line"></i><span> Health Report</span></a> -->
    <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i><span> Logout</span></a>
  </div>

  <div class="main-content" id="mainContent">
    <div class="navbar-custom">
      <span class="toggle-btn" id="toggleBtn"><i class="fas fa-bars"></i></span>
      <div class="user-profile">
        <strong id="welcome-text">Welcome, <?= htmlspecialchars($_SESSION['name']); ?> !</strong>  
      </div>
    </div>

    <div class="heading">
      <h1 class="text-center"><i class="fa-solid fa-heartbeat"></i> Diet & Health Tracker </h1>
    </div>

  <div id="content-area"> 
    <div class="info-section">
      <div class="info-content">
        <h5>Diet & Health Tracking</h5>
        <ul style="font-family: Arial, sans-serif; line-height: 1.8; font-size: 16px; color: #333;">
          <li>Tracking your food and drink intake helps you maintain and manage your weight effectively.</li>
           <li>It supports you in following a healthy diet, which improves your overall health and well-being.</li>
          <li>It can assist in managing health conditions such as diabetes and high blood pressure by keeping your nutrition in check.</li>
           <li>By ensuring a proper nutritional balance, it helps maintain steady energy levels throughout the day.</li>
          <li>Additionally, it builds awareness of your eating habits, making it easier to make informed and healthier choices.</li>
          <li>Over time, this practice encourages long-term lifestyle changes that contribute to better fitness and wellness.</li>
        </ul>
      </div>
    </div>
  </div>

  <script>
    // Sidebar toggle for small screens
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleBtn');
    const mainContent = document.getElementById('mainContent');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('collapsed');
      mainContent.classList.toggle('expanded');
    });

    // Simple table sorting function
    function sortTable(colIndex) {
      const table = document.querySelector('table');
      let switching = true;
      let dir = "asc"; 
      let switchcount = 0;
      while (switching) {
        switching = false;
        let rows = table.rows;
        for (let i = 1; i < rows.length - 1; i++) {
          let shouldSwitch = false;
          let x = rows[i].getElementsByTagName("TD")[colIndex];
          let y = rows[i + 1].getElementsByTagName("TD")[colIndex];
          let xContent = x.textContent || x.innerText;
          let yContent = y.textContent || y.innerText;

          if (colIndex === 1) { 
            xContent = parseInt(xContent);
            yContent = parseInt(yContent);
          } else if (colIndex === 2) {
            xContent = new Date(xContent);
            yContent = new Date(yContent);
          }

          if (dir === "asc" ? (xContent > yContent) : (xContent < yContent)) {
            shouldSwitch = true;
            break;
          }
        }
        if (shouldSwitch) {
          rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
          switching = true;
          switchcount++;
        } else {
          if (switchcount === 0 && dir === "asc") {
            dir = "desc";
            switching = true;
          }
        }
      }
    }
    
  // For My Profile
  // Function to load pages via AJAX
  function loadPage(pageUrl) {
    fetch(pageUrl)
      .then(response => response.text())
      .then(data => {
        document.getElementById('content-area').innerHTML = data;

        // If profile page is loaded, activate edit/save functionality
        if (pageUrl.includes("view_profile.php")) {
          setTimeout(() => activateProfileEdit(), 100); // call our function
        }
      })
      .catch(err => console.log(err));
  }

  // For My Profile Updation / Deletion
  function activateProfileEdit() 
  {
    // Edit
    const editBtn = document.getElementById("edit-btn");
    const saveBtn = document.getElementById("save-btn");
    const cancelBtn = document.getElementById("cancel-btn");
    const viewFields = document.querySelectorAll(".view-field");
    const editFields = document.querySelectorAll(".edit-field");

    editBtn.addEventListener("click", () => {
        viewFields.forEach(v => v.style.display = "none");
        editFields.forEach(e => e.style.display = "block");
        editBtn.style.display = "none";
        saveBtn.style.display = "inline-block";
        cancelBtn.style.display = "inline-block";
    });

    // Cancel
    cancelBtn.addEventListener("click", () => {
        viewFields.forEach(v => v.style.display = "inline");
        editFields.forEach(e => e.style.display = "none");
        editBtn.style.display = "inline-block";
        saveBtn.style.display = "none";
        cancelBtn.style.display = "none";
    });

    // Delete

    const deleteBtn = document.getElementById("delete-btn");

    deleteBtn.addEventListener("click", () => {
      if(confirm("Are you sure you want to delete your profile? This action cannot be undone.")) {
        fetch("delete_profile.php", { method: "POST" })
        .then(res => res.text())
        .then(data => {
            if(data.trim() === "success"){
                alert("Profile deleted successfully!");
                window.location.href = "login.php"; // redirect to login page
            } else {
                alert("Delete failed: " + data);
            }
        })
        .catch(err => console.log(err));
      }
    });

    document.getElementById("profileForm").addEventListener("submit", function(e){
        e.preventDefault();
        const formData = new FormData(this);

        fetch("update_profile.php", { method: "POST", body: formData })
        .then(res => res.text())
        .then(data => {
            if(data.trim() === "success")
            {
                alert("Profile Updated Successfully!");
                loadPage("view_profile.php");

                // Get new name from form input
                const newName = document.querySelector('input[name="name"]').value;

                // Update welcome text in dashboard without reload
                document.getElementById("welcome-text").textContent = "Welcome, " + newName;

            } 
            else 
            {
              alert("Update failed: " + data);
            }
        });
    });
  }

// Function to load page via AJAX
function loadPage(pageUrl) {
    fetch(pageUrl)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content-area').innerHTML = data;

            // Activate specific page scripts
            if (pageUrl.includes("view_profile.php")) {
                setTimeout(() => activateProfileEdit(), 100);
            } else if (pageUrl.includes("view_health.php")) {
                setTimeout(() => activateHealthInsert(), 100);
            }
        })
        .catch(err => console.log(err));
}

// Health form submit with message box
function activateHealthInsert() {
    const healthForm = document.getElementById("healthForm");
    if (!healthForm) return console.error("❌ Health form not found!");

    // Prevent multiple event listeners
    if (healthForm.dataset.bound === "true") return;
    healthForm.dataset.bound = "true";

    // Add message box above form
    let healthMessage = document.getElementById("healthMessage");
    if (!healthMessage) {
        healthMessage = document.createElement("div");
        healthMessage.id = "healthMessage";
        healthMessage.style.marginBottom = "15px";
        healthMessage.style.padding = "10px";
        healthMessage.style.borderRadius = "8px";
        healthMessage.style.fontWeight = "bold";
        healthForm.parentNode.insertBefore(healthMessage, healthForm);
    }

    healthForm.addEventListener("submit", function(e){
        e.preventDefault();
        const formData = new FormData(this);

        fetch("insert_health.php", { method: "POST", body: formData })
        .then(res => res.json())
        .then(data => {
            healthMessage.style.display = "block";
            healthMessage.style.color = data.status==="success" ? "green" : "red";
            healthMessage.style.backgroundColor = data.status==="success" ? "#d4edda" : "#f8d7da";
            healthMessage.textContent = data.message;

            if(data.status==="success"){
                healthForm.reset();
                setTimeout(() => loadPage("view_health.php"), 1000); // reload form content
            }
        })
        .catch(err => console.error("❌ Fetch Error:", err));
    });
}


  </script>
</body>

</html>