document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("table").forEach((table) => {
      const headers = table.querySelectorAll("th");
      headers.forEach((th, index) => {
        let asc = true;
        th.style.cursor = "pointer";
        th.addEventListener("click", () => {
          const rows = Array.from(table.querySelectorAll("tbody tr"));
          rows.sort((a, b) => {
            const aText = a.children[index].textContent.trim();
            const bText = b.children[index].textContent.trim();
            const aNum = parseFloat(aText);
            const bNum = parseFloat(bText);
  
            if (!isNaN(aNum) && !isNaN(bNum)) {
              return asc ? aNum - bNum : bNum - aNum;
            } else {
              return asc
                ? aText.localeCompare(bText, 'ru', { sensitivity: 'base' })
                : bText.localeCompare(aText, 'ru', { sensitivity: 'base' });
            }
          });
          table.querySelector("tbody").innerHTML = "";
          rows.forEach((row) => table.querySelector("tbody").appendChild(row));
          asc = !asc;
        });
      });
    });
  });
  