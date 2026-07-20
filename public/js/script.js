/* ============================================================
   UTILS
============================================================ */
function el(selector) {
    return document.querySelector(selector);
}
function els(selector) {
    return Array.from(document.querySelectorAll(selector));
}

/* ============================================================
   NAVIGATION — fonction centrale réutilisable
============================================================ */
function navigateTo(sectionId) {
    const navItems = els('#sidebar-wrapper .nav-item[data-section]');

    // Masquer toutes les sections
    els('.content-section').forEach(section => {
        section.style.display = 'none';
    });

    // Afficher la cible
    const target = document.getElementById(sectionId);
    if (target) {
        target.style.display = 'block';
        target.scrollIntoView({ behavior: 'smooth' });
    }

    // Synchroniser le sidebar
    navItems.forEach(nav => nav.classList.remove('active'));
    const matchingNav = navItems.find(
        nav => nav.getAttribute('data-section') === sectionId
    );
    matchingNav?.classList.add('active');

    // Mise à jour de l'URL
    history.pushState({ section: sectionId }, '', `#${sectionId}`);
}

/* ============================================================
   RESTAURATION — lecture du hash au chargement
============================================================ */
function restoreFromHash() {
    const hash = window.location.hash.replace('#', '');
    if (hash) {
        navigateTo(hash);
    } else {
        navigateTo('accueil');
    }
}

/* ============================================================
   ASIDE MENU — fichcraft/facelaim
============================================================ */
function initAsideMenu() {
    const asideMenu = el('.menufichecraft');
    if (!asideMenu) return;

    const closeBtn = el('.close-btn');
    const openBtn  = el('.open-btn');

    function toggleMenu() {
        asideMenu.classList.toggle('open');
        asideMenu.classList.toggle('closed');
    }

    closeBtn?.addEventListener('click', toggleMenu);
    openBtn?.addEventListener('click', toggleMenu);
}

/* ============================================================
   TRIEUR — navigation par sections (sidebar)
============================================================ */
function initTrieur() {
    const navItems = els('#sidebar-wrapper .nav-item[data-section]');
    if (navItems.length === 0) return;

    // Tooltips Bootstrap 5
    els('[data-bs-toggle="tooltip"]').forEach(tooltipEl => {
        new bootstrap.Tooltip(tooltipEl);
    });

    // Clics sur les items du sidebar
    navItems.forEach(item => {
        const link = item.querySelector('a');
        if (!link) return;

        link.addEventListener('click', function (e) {
            e.preventDefault();
            navigateTo(item.getAttribute('data-section'));
        });
    });

    // Bouton retour/avant du navigateur
    window.addEventListener('popstate', function (e) {
        if (e.state?.section) {
            navigateTo(e.state.section);
        } else {
            navigateTo('accueil');
        }
    });
}

/* ============================================================
   SECTION LINKS — liens internes data-target-section
============================================================ */
function initSectionLinks() {
    const links = els('[data-target-section]');
    if (links.length === 0) return;

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const sectionId = this.getAttribute('data-target-section');
            navigateTo(sectionId);
        });
    });
}

/* ============================================================
   ONGLETS
============================================================ */
function initOnglets() {
    const onglets = els('.onglet');
    if (onglets.length === 0) return;

    const contenu = els('.contenu');
    if (contenu.length === 0) return;

    if (onglets.length !== contenu.length) {
        console.warn('initOnglets : nombre d\'onglets et de contenus différents');
        return;
    }

    let index = 0;

    onglets.forEach(onglet => {
        onglet.addEventListener('click', function () {
            onglets[index].classList.remove('active');
            contenu[index].classList.remove('active-contenu');

            index = onglets.indexOf(this);

            onglets[index].classList.add('active');
            contenu[index].classList.add('active-contenu');
        });
    });
}

/* ============================================================
   ACCORDEON — section aides
============================================================ */
function initAccordeon() {
    const headers = els('.accordion-header');
    if (headers.length === 0) return;

    headers.forEach(header => {
        header.addEventListener('click', function () {
            this.parentElement.classList.toggle('active');
        });
    });
}

/* ============================================================
   FICHE — restauration localStorage
============================================================ */
function restoreFromStorage(sheetId) {
    const key   = `sheet_${sheetId}`;
    const saved = localStorage.getItem(key);
    if (!saved) return;

    let values;
    try {
        values = JSON.parse(saved);
    } catch (e) {
        console.warn('localStorage corrompu pour', key);
        localStorage.removeItem(key);
        return;
    }

    els('.sheet-input').forEach(input => {
        const field = input.dataset.field;
        if (field && values[field] && !input.value) {
            input.value = values[field];
        }
    });
}

function initFiche() {
    const sheetEl = el('[data-sheet-id]');
    if (!sheetEl) return;

    const sheetId = sheetEl.dataset.sheetId;
    restoreFromStorage(sheetId);
}

/* ============================================================
   INIT GLOBALE
============================================================ */
document.addEventListener('DOMContentLoaded', function () {
    initAsideMenu();
    initTrieur();
    initSectionLinks();
    initOnglets();
    initAccordeon();
    initFiche();

    // Restauration de la section via le hash
    restoreFromHash();
});

// Ré-initialisation après chaque re-render Livewire
document.addEventListener('livewire:navigated', () => {
    initOnglets();
    restoreFromHash();
});
document.addEventListener('livewire:update', () => {
    initOnglets();
    restoreFromHash();
});
