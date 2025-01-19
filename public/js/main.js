 // Dropdown toggle
 document.getElementById('dropdownButton').addEventListener('click', () => {
    const dropdownMenu = document.getElementById('dropdownMenu');
    dropdownMenu.classList.toggle('hidden');
});

// Modal open/close
document.querySelectorAll('[data-modal-target]').forEach(button => {
    button.addEventListener('click', () => {
        const modal = document.querySelector(button.getAttribute('data-modal-target'));
        modal.classList.remove('hidden');
    });
});

document.querySelectorAll('[data-modal-close]').forEach(button => {
    button.addEventListener('click', () => {
        button.closest('.fixed').classList.add('hidden');
    });
});