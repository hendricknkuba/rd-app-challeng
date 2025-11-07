import "./style.css";
import { getResources } from "./api";
import { renderResources } from "./ui";

async function load(level: string = "beginner") {
  const resources = await getResources(level);
  renderResources(resources);
}

document.getElementById("filter")!.addEventListener("change", (e) => {
  const value = (e.target as HTMLSelectElement).value;
  load(value);
});

load();