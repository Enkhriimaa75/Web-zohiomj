(function () {
  const form = document.getElementById('todo-form');
  const input = document.getElementById('todo-input');
  const list = document.getElementById('todo-list');
  const clearBtn = document.getElementById('clear-completed');
  const countEl = document.getElementById('count');

  const STORAGE_KEY = 'lab8_todos_v1';

  function load() {
    try { return JSON.parse(localStorage.getItem(STORAGE_KEY)) || []; }
    catch { return []; }
  }
  function save(items) {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(items));
  }

  function render(items) {
    list.innerHTML = '';
    items.forEach((item, idx) => {
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex align-items-center justify-content-between';
      li.innerHTML = `
        <div class="form-check">
          <input class="form-check-input" type="checkbox" id="todo-${idx}" ${item.done ? 'checked' : ''}>
          <label class="form-check-label ${item.done ? 'text-decoration-line-through text-muted' : ''}" for="todo-${idx}">
            ${escapeHtml(item.text)}
          </label>
        </div>
        <button class="btn btn-sm btn-outline-danger" data-action="delete" aria-label="Delete">✕</button>
      `;
      li.querySelector('input').addEventListener('change', () => {
        items[idx].done = !items[idx].done;
        save(items); render(items);
      });
      li.querySelector('[data-action="delete"]').addEventListener('click', () => {
        items.splice(idx, 1);
        save(items); render(items);
      });
      list.appendChild(li);
    });
    countEl.textContent = `${items.length} item${items.length !== 1 ? 's' : ''}`;
  }

  function escapeHtml(s) {
    return s.replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
  }

  const items = load();
  render(items);

  form.addEventListener('submit', (e) => {
    e.preventDefault();
    const text = input.value.trim();
    if (!text) return;
    items.push({ text, done: false });
    input.value = '';
    save(items); render(items);
  });

  clearBtn.addEventListener('click', () => {
    for (let i = items.length - 1; i >= 0; i--) {
      if (items[i].done) items.splice(i, 1);
    }
    save(items); render(items);
  });
})();
