using System;

[Serializable]

public class ItemsResponse
{
    public string status;
    public Item[] data;
}

[Serializable]

public class ItemResponse
{
    public string status;
    public string message; 

    public Item data;

}
