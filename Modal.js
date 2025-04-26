document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal-login");
    const openBtn = document.querySelector(".open-modal");
    const closeBtn = document.querySelector(".close-modal");
  
    openBtn.addEventListener("click", () => {
      modal.classList.add("visible");
    });
  
    closeBtn.addEventListener("click", () => {
      modal.classList.remove("visible");
    });
  
    window.addEventListener("keydown", (e) => {
      if (e.key === "Escape") {
        modal.classList.remove("visible");
      }
    });
  });
  