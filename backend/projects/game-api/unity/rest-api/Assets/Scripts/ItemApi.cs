using System;
using System.Collections;
using System.Text;
using UnityEngine;
using UnityEngine.Networking;

public class ItemApi : MonoBehaviour
{
    private const string API_URL =
        "http://localhost:3000/items.php";


    public IEnumerator GetItems(Action<Item[]> onSuccess)
    {
        using UnityWebRequest request =
            UnityWebRequest.Get(API_URL);

        request.SetRequestHeader(
            "Accept",
            "application/json"
        );

        yield return request.SendWebRequest();

        if (request.result != UnityWebRequest.Result.Success)
        {
            Debug.LogError(request.error);
            yield break;
        }

        Debug.Log(request.downloadHandler.text);

        ItemsResponse response =
            JsonUtility.FromJson<ItemsResponse>(
                request.downloadHandler.text
            );

        onSuccess?.Invoke(response.data ?? Array.Empty<Item>());
    }


    public IEnumerator CreateItem(
        Item item,
        Action<Item> onSuccess
    )
    {
        string json = JsonUtility.ToJson(item);

        using UnityWebRequest request =
            new UnityWebRequest(API_URL, "POST");

        byte[] body =
            Encoding.UTF8.GetBytes(json);

        request.uploadHandler =
            new UploadHandlerRaw(body);

        request.downloadHandler =
            new DownloadHandlerBuffer();

        request.SetRequestHeader(
            "Content-Type",
            "application/json"
        );

        yield return request.SendWebRequest();

        if (request.result != UnityWebRequest.Result.Success)
        {
            Debug.LogError(request.error);
            yield break;
        }

        Debug.Log(request.downloadHandler.text);

        ItemResponse response =
            JsonUtility.FromJson<ItemResponse>(
                request.downloadHandler.text
            );

        onSuccess?.Invoke(response.data);
    }


    public IEnumerator UpdateItem(
        Item item,
        Action<Item> onSuccess
    )
    {
        string json = JsonUtility.ToJson(item);

        string url =
            $"{API_URL}?id={item.id}";

        using UnityWebRequest request =
            new UnityWebRequest(url, "PUT");

        byte[] body =
            Encoding.UTF8.GetBytes(json);

        request.uploadHandler =
            new UploadHandlerRaw(body);

        request.downloadHandler =
            new DownloadHandlerBuffer();

        request.SetRequestHeader(
            "Content-Type",
            "application/json"
        );

        yield return request.SendWebRequest();

        if (request.result != UnityWebRequest.Result.Success)
        {
            Debug.LogError(request.error);
            yield break;
        }

        Debug.Log(request.downloadHandler.text);

        ItemResponse response =
            JsonUtility.FromJson<ItemResponse>(
                request.downloadHandler.text
            );

        onSuccess?.Invoke(response.data);
    }


    public IEnumerator DeleteItem(
        int id,
        Action<bool> onSuccess
    )
    {
        string url =
            $"{API_URL}?id={id}";

        using UnityWebRequest request =
            UnityWebRequest.Delete(url);

        request.downloadHandler =
            new DownloadHandlerBuffer();

        yield return request.SendWebRequest();

        if (request.result != UnityWebRequest.Result.Success)
        {
            Debug.LogError(request.error);
            onSuccess?.Invoke(false);
            yield break;
        }

        Debug.Log(request.downloadHandler.text);

        onSuccess?.Invoke(true);
    }
}
