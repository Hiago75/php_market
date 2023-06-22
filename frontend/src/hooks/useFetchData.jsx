import { useEffect, useState } from "react";

export default function useFetchData(url) {
  const [data, setData] = useState(null);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await fetch(url);
        const responseData = await response.json();
        setData(responseData);
        setLoading(false);
      } catch (error) {
        setError(error);
        setLoading(false);
        throw new Error(error);
      }
    };

    fetchData();
  }, []);

  return { data, loading, error };
}
