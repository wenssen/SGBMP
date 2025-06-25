document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const navbar = document.getElementById('mainNavbar');
    const toggleBtn = document.getElementById('themeToggle');
    const icon = document.getElementById('themeIcon');

    if (!toggleBtn || !navbar || !icon) {
        console.warn("🔴 Elemento faltante: no se puede aplicar el cambio de tema.");
        return;
    }

    function applyTheme(theme) {
        const dark = theme === 'dark';
        body.classList.toggle('dark-mode', dark);
        navbar.classList.toggle('dark-mode', dark);

        document.querySelectorAll('table').forEach(table => {
            table.classList.toggle('dark-mode', dark);
        });

        icon.classList.remove('fa-moon', 'fa-sun');
        icon.classList.add(dark ? 'fa-sun' : 'fa-moon');
    }

    const savedTheme = localStorage.getItem('theme') || 'light';
    applyTheme(savedTheme);

    toggleBtn.addEventListener('click', () => {
        const current = body.classList.contains('dark-mode') ? 'dark' : 'light';
        const next = current === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', next);
        applyTheme(next);
    });
});

