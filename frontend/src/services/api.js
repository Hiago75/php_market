import { toast } from "react-toastify";

export async function makeRequest(url, method, data, successMessage) {
  try {
    const response = await fetch(url, {
      method: method,
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(data),
    });

    if (response.ok) {
      const result = await response.json();
      toast.success(successMessage);
      return result;
    } else {
      const errorData = await response.json();
      toast.error(errorData.error);
    }
  } catch (error) {
    toast.error("Opa, parece que algo deu errado.");
  }
}
