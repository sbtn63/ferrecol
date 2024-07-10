document.querySelectorAll('.toggle-button').forEach(button => {
    button.addEventListener('click', function() {
        var targetId = this.getAttribute('data-toggle-target');
        var targetElement = document.querySelector(targetId);
        
        if (targetElement.classList.contains('hidden')) {
            targetElement.classList.remove('hidden');
        } else {
            targetElement.classList.add('hidden');
        }
    });
});