document.querySelectorAll('.quantity-selector').forEach(selector => {
  const input = selector.querySelector('input');
  selector.querySelector('.increment').addEventListener('click', () => {
    input.value = parseInt(input.value || 0) + 1;
  });
  selector.querySelector('.decrement').addEventListener('click', () => {
    input.value = Math.max(0, parseInt(input.value || 0) - 1);
  });
});
