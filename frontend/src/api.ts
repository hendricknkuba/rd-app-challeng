export interface Resource {
  id: number;
  title: string;
  level: "beginner" | "intermediate" | "advanced";
  summary: string | null;
  reading_estimate: number;
}

export async function getResources(minLevel: string = "beginner"): Promise<Resource[]> {
  const response = await fetch(
    `http://localhost/wordpress/wp-json/test/v1/resources?min_level=${minLevel}`
  );
  return await response.json();
}
