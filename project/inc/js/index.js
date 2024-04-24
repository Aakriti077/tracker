// // Executes when document is loaded
// document.addEventListener("DOMContentLoaded", (ev) => {
//   // Recent Orders Data
//   document.getElementById("recent-orders--table").appendChild(buildTableBody());

//   // Updates Data
//   document
//     .getElementsByClassName("recent-updates")
//     .item(0)
//     .appendChild(buildUpdatesList());

//   // Sales Analytics
//   const salesAnalytics = document.getElementById("analytics");
//   buildSalesAnalytics(salesAnalytics);
// });

// Document Builder
// const buildTableBody = () => {
//   const recentOrderData = RECENT_ORDER_DATA;

//   const tbody = document.createElement("tbody");

//   let bodyContent = "";
//   for (const row of recentOrderData) {
//     bodyContent += `
//       <tr>
//         <td>${row.productName}</td>
//         <td>${row.productNumber}</td>
//         <td>${row.payment}</td>
//         <td class="${row.statusColor}">${row.status}</td>
//         <td class="primary">Details</td>
//       </tr>
//     `;
//   }

//   tbody.innerHTML = bodyContent;

//   return tbody;
// };

// const buildUpdatesList = () => {
//   const updateData = UPDATE_DATA;

//   const div = document.createElement("div");
//   div.classList.add("updates");

//   let updateContent = "";
//   for (const update of updateData) {
//     updateContent += `
//       <div class="update">
//         <div class="profile-photo">
//           <img src="${update.imgSrc}" />
//         </div>
//         <div class="message">
//           <p><b>${update.profileName}</b> ${update.message}</p>
//           <small class="text-muted">${update.updatedTime}</small>
//         </div>
//       </div>
//     `;
//   }

//   div.innerHTML = updateContent;

//   return div;
// };

// const buildSalesAnalytics = (element) => {
//   const salesAnalyticsData = SALES_ANALYTICS_DATA;

//   for (const analytic of salesAnalyticsData) {
//     const item = document.createElement("div");
//     item.classList.add("item");
//     item.classList.add(analytic.itemClass);

//     const itemHtml = `
//       <div class="icon">
//         <span class="material-icons-sharp"> ${analytic.icon} </span>
//       </div>
//       <div class="right">
//         <div class="info">
//           <h3>${analytic.title}</h3>
//           <small class="text-muted"> Last 24 Hours </small>
//         </div>
//         <h5 class="${analytic.colorClass}">${analytic.percentage}%</h5>
//         <h3>${analytic.sales}</h3>
//       </div>
//     `;

//     item.innerHTML = itemHtml;

//     element.appendChild(item);
//   }
// };



// Function to load the dashboard content
// function loadDashboard() {
//     console.log('Loading dashboard...');
//     // You can fetch the original content for the dashboard from the server if needed
//     document.getElementById('main-content').innerHTML = `
//         <h1>Dashboard</h1>
//          <div id="main-content">
//         <!-- Income form will be loaded here -->
//     </div>

//         <div class="insights">
          
//           <div class="total">
//             <span class="material-symbols-sharp"> paid </span>
//             <div class="middle">
//               <div class="left">
//                 <h3>Total Amount</h3>
//                 <h1>$<?php echo $total_amount; ?></h1>
//               </div>
//             </div>
//             <small class="text-muted"> Last total </small>
//           </div>

//           <!-- EXPENSES -->
//           <div class="expenses">
//             <span class="material-symbols-sharp"> receipt_long </span>
//             <div class="middle">
//               <div class="left">
//                 <h3>Total Expenses</h3>
//                 <h1>$<?php echo $total_expense; ?></h1>
//               </div>
//             </div>
//             <small class="text-muted"> Last expenses </small>
//           </div>

//           <!-- INCOME -->
//           <div class="income">
//             <span class="material-symbols-sharp"> payments </span>
//             <div class="middle">
//               <div class="left">
//                 <h3>Total Income</h3>
//                 <h1>$<?php echo $total_income; ?></h1>
//               </div>
//             </div>
//             <small class="text-muted"> Last income </small>
//           </div>
//         </div>

//         <div class="box">
//             <h1>Bar graphs here</h1>
//         </div>

//     `;
// }


// Document operation functions
const sideMenu = document.querySelector("aside");
const menuBtn = document.querySelector("#menu-btn");
const closeBtn = document.querySelector("#close-btn");
const themeToggler = document.querySelector(".theme-toggler");

// Show Sidebar
menuBtn.addEventListener("click", () => {
  sideMenu.style.display = "block";
});

// Hide Sidebar
closeBtn.addEventListener("click", () => {
  sideMenu.style.display = "none";
});

// Change Theme
themeToggler.addEventListener("click", () => {
  document.body.classList.toggle("dark-theme-variables");

  themeToggler.querySelector("span:nth-child(1)").classList.toggle("active");
  themeToggler.querySelector("span:nth-child(2)").classList.toggle("active");
});


// Get all links in the sidebar
const sidebarLinks = document.querySelectorAll('.sidebar a');

// Function to remove active class from all links except the clicked one
function removeActiveClassExceptClicked(clickedLink) {
    sidebarLinks.forEach(link => {
        if (link !== clickedLink) {
            link.classList.remove('active');
        }
    });
}

// Add click event listener to each link
sidebarLinks.forEach(link => {
    link.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent default link behavior
        // Remove active class from all links except the clicked one
        removeActiveClassExceptClicked(link);
        // Add active class to the clicked link
        link.classList.add('active');
    });
});



  //change pp

// Get the profile image and file input elements
const profileImage = document.getElementById('profile-image');
const profilePictureInput = document.getElementById('profile-picture-input');

// Add click event listener to the profile image
profileImage.addEventListener('click', () => {
    // Trigger the file input when the image is clicked
    profilePictureInput.click();
});

// Add change event listener to the file input
profilePictureInput.addEventListener('change', (event) => {
    // Get the selected file
    const selectedFile = event.target.files[0];

    // Check if a file is selected
    if (selectedFile) {
        // Create a FileReader object
        const reader = new FileReader();

        // Set up the FileReader onload function
        reader.onload = () => {
            // Set the profile image source to the selected file
            profileImage.src = reader.result;
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(selectedFile);
    }
});



// Function to load the income form
// function loadIncome() {
//   console.log('Loading income...');
//   var xhr = new XMLHttpRequest();
//   xhr.open('GET', 'income.php', true);
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       document.getElementById('income-container').innerHTML = xhr.responseText;
//       document.getElementById('expense-container').innerHTML = ''; // Hide expense form
//       document.querySelector('.right').style.display = 'block'; // Show right content
//     }
//   };
//   xhr.send();
// }

// // Function to load the expense form
// function loadExpenses() {
//   console.log('Loading expenses...');
//   var xhr = new XMLHttpRequest();
//   xhr.open('GET', 'expense.php', true);
//   xhr.onreadystatechange = function () {
//     if (xhr.readyState == 4 && xhr.status == 200) {
//       document.getElementById('expense-container').innerHTML = xhr.responseText;
//       document.getElementById('income-container').innerHTML = ''; // Hide income form
//       document.querySelector('.right').style.display = 'block'; // Show right content
//     }
//   };
//   xhr.send();
// }

var originalContent = document.getElementById('main-content').innerHTML; // Store original content

// Function to load the income form
function loadIncome() {
  console.log('Loading income...');
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'income.php', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var incomeContainer = document.createElement('div');
      incomeContainer.id = 'income-container';
      incomeContainer.innerHTML = xhr.responseText;
      document.getElementById('main-content').innerHTML = '';
      document.getElementById('main-content').appendChild(incomeContainer);
      document.getElementById('expense-container').innerHTML = ''; // Hide expense form
      var dashboardContainer = document.getElementById('dashboard-container');
      if (dashboardContainer) {
        dashboardContainer.innerHTML = ''; // Hide dashboard content
      }
      document.querySelector('.right').style.display = 'block'; // Show right content
    }
  };
  xhr.send();
}

// Function to load the expense form
function loadExpenses() {
  console.log('Loading expenses...');
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'expense.php', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var expenseContainer = document.createElement('div');
      expenseContainer.id = 'expense-container';
      expenseContainer.innerHTML = xhr.responseText;
      document.getElementById('main-content').innerHTML = '';
      document.getElementById('main-content').appendChild(expenseContainer);
      document.getElementById('income-container').innerHTML = ''; // Hide income form
      var dashboardContainer = document.getElementById('dashboard-container');
      if (dashboardContainer) {
        dashboardContainer.innerHTML = ''; // Hide dashboard content
      }
      document.querySelector('.right').style.display = 'block'; // Show right content
    }
  };
  xhr.send();
}

function showDashboard() {
  console.log('Loading dashboard...');
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'dashboard.php', true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState == 4 && xhr.status == 200) {
      var dashboardContainer = document.createElement('div');
      dashboardContainer.id = 'dashboard-container';
      dashboardContainer.innerHTML = xhr.responseText;
      document.getElementById('main-content').innerHTML = '';
      document.getElementById('main-content').appendChild(dashboardContainer);
      document.getElementById('income-container').innerHTML = ''; // Hide income form
      document.getElementById('expense-container').innerHTML = ''; // Hide expense form
      document.querySelector('.right').style.display = 'block'; // Show right content
    }
  };
  xhr.send();
}


// Function to handle navigation clicks
// function handleNavigation(event) {
//     event.preventDefault(); // Prevent default link behavior
//     const target = event.target;
//     if (target.classList.contains('dashboard-link')) {
//         loadDashboard();
//     } else if (target.classList.contains('income-link')) {
//         loadIncomeForm();
//     }
// }

// // Event listener for navigation clicks
// document.addEventListener('click', function(event) {
//     if (event.target && event.target.matches('.dashboard-link, .income-link')) {
//         handleNavigation(event);
//     }
// });

    