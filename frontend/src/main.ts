import { getResources } from "./api";
import { renderResources } from "./ui";

const filter = document.getElementById("filter") as HTMLSelectElement;
const loadingElement = document.getElementById("loading")!;
const app = document.getElementById("app")!;

function sleep(ms: number) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

async function loadAndRenderResources() {
  loadingElement.classList.remove("hidden");
  app.innerHTML = "";

  await sleep(500);

  const data = await getResources(filter.value);

  loadingElement.classList.add("hidden");
  renderResources(data);
}

filter.addEventListener("change", loadAndRenderResources);

loadAndRenderResources();
