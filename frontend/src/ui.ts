import type { Resource } from "./api";

export function renderResources(resources: Resource[]) {
  const container = document.getElementById("app")!;
  container.innerHTML = "";

  resources.forEach((r) => {
    const div = document.createElement("div");

    div.className = `
      w-full max-w-xl
      bg-white rounded-lg p-4 shadow-sm border border-gray-200
      hover:border-gray-300 hover:shadow transition
    `;

    div.innerHTML = `
      <div class="flex justify-between items-center mb-2">
        <h2 class="font-semibold text-lg">${r.title}</h2>
        <span class="text-[10px] px-2 py-1 rounded bg-gray-100 text-gray-600 uppercase">
          ${r.level}
        </span>
      </div>

      <p class="text-sm text-gray-600">
        ${r.summary ?? "<i>(Login required)</i>"}
      </p>

      <p class="mt-3 text-xs text-gray-400">${r.reading_estimate} min read</p>
    `;

    container.appendChild(div);
  });
}
