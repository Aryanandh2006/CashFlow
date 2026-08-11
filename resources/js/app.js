//

import.meta.glob(["../assets/**"]);

document.addEventListener("DOMContentLoaded", () => {
    const themeToggle = document.getElementById("theme-toggle");
    const htmlElement = document.documentElement;

    // Set the initial checkbox state based on the active theme
    if (htmlElement.getAttribute("data-theme") === "dark") {
        themeToggle.checked = true;
    }

    // Handle toggle action
    themeToggle.addEventListener("change", () => {
        if (themeToggle.checked) {
            htmlElement.setAttribute("data-theme", "dark");
            localStorage.setItem("theme", "dark");
        } else {
            htmlElement.setAttribute("data-theme", "light");
            localStorage.setItem("theme", "light");
        }
    });

    const isInitialDark = htmlElement.getAttribute("data-theme") === "dark";

    // Set the initial checkbox state based on the active theme
    if (isInitialDark) {
        themeToggle.checked = true;
    }

    const chartContainer = document.querySelector("#chart");

    // Safely parse strings back to JS arrays
    const chartLabels = JSON.parse(chartContainer.dataset.labels);
    const incomeData = JSON.parse(chartContainer.dataset.income);
    const expenseData = JSON.parse(chartContainer.dataset.expense);

    // 3. Define configuration options using the initial theme state
    var options = {
        series: [
            {
                name: "Income",
                data: incomeData,
            },
            {
                name: "Expense",
                data: expenseData,
            },
        ],
        colors: ["#00E396", "#ff4a4a"],
        chart: {
            id: "financial-chart",
            height: 350,
            type: "area",
        },
        theme: {
            mode: isInitialDark ? "dark" : "light", // Dynamic initial theme
        },
        dataLabels: {
            enabled: false,
        },
        stroke: {
            curve: "smooth",
        },
        title: {
            text: "Your Transactions this month",
            align: "left",
            style: {
                color: isInitialDark ? "#FFFFFF" : "#373D3F", // Dynamic initial title
            },
        },
        xaxis: {
            categories: chartLabels,
            labels: {
                style: {
                    colors: isInitialDark ? "#A3A3A3" : "#78909C", // Dynamic initial x-axis labels
                },
            },
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return "€" + val;
                },
                style: {
                    colors: [isInitialDark ? "#A3A3A3" : "#78909C"], // Dynamic initial y-axis labels
                },
            },
        },
        legend: {
            labels: {
                colors: isInitialDark ? "#FFFFFF" : "#373D3F", // Dynamic initial legend
            },
        },
        tooltip: {
            x: {
                format: "dd MMM yyyy",
            },
        },
    };

    // 4. Render the chart
    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

    // 5. Handle toggle action and update chart
    themeToggle.addEventListener("change", () => {
        const isDark = themeToggle.checked;

        if (isDark) {
            htmlElement.setAttribute("data-theme", "dark");
            localStorage.setItem("theme", "dark");
        } else {
            htmlElement.setAttribute("data-theme", "light");
            localStorage.setItem("theme", "light");
        }

        // Call the theme switcher update function
        updateChartTheme(isDark);
    });
});

function updateChartTheme(isDarkMode) {
    var textPrimary = isDarkMode ? "#FFFFFF" : "#373D3F";
    var textSecondary = isDarkMode ? "#A3A3A3" : "#78909C";

    ApexCharts.exec("financial-chart", "updateOptions", {
        theme: {
            mode: isDarkMode ? "dark" : "light",
        },
        title: {
            style: {
                color: textPrimary,
            },
        },
        xaxis: {
            labels: {
                style: {
                    colors: textSecondary,
                },
            },
        },
        yaxis: {
            labels: {
                style: {
                    colors: [textSecondary],
                },
            },
        },
        legend: {
            labels: {
                colors: textPrimary,
            },
        },
    });
}
