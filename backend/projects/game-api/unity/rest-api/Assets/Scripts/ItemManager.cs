using System.Text;
using TMPro;
using UnityEngine;

public class ItemManager : MonoBehaviour
{
    [SerializeField] private ItemApi api;

    [Header("Inputs")]
    [SerializeField] private TMP_InputField idInput;
    [SerializeField] private TMP_InputField nameInput;
    [SerializeField] private TMP_InputField categoryInput;
    [SerializeField] private TMP_InputField rarityInput;
    [SerializeField] private TMP_InputField priceInput;

    [Header("Output")]
    [SerializeField] private TMP_Text outputText;


    public void LoadItems()
    {
        StartCoroutine(
            api.GetItems(items =>
            {
                StringBuilder output =
                    new StringBuilder();

                foreach (Item item in items)
                {
                    output.AppendLine(
                        $"{item.id} | " +
                        $"{item.name} | " +
                        $"{item.category} | " +
                        $"{item.rarity} | " +
                        $"{item.price:F2}"
                    );
                }

                outputText.text =
                    output.ToString();
            })
        );
    }


    public void CreateItem()
    {
        Item item = new Item
        {
            name = nameInput.text,
            category = categoryInput.text,
            rarity = rarityInput.text,
            price = float.Parse(priceInput.text)
        };

        StartCoroutine(
            api.CreateItem(
                item,
                createdItem =>
                {
                    Debug.Log(
                        $"Created: {createdItem.name}"
                    );

                    LoadItems();
                }
            )
        );
    }


    public void UpdateItem()
    {
        Item item = new Item
        {
            id = int.Parse(idInput.text),
            name = nameInput.text,
            category = categoryInput.text,
            rarity = rarityInput.text,
            price = float.Parse(priceInput.text)
        };

        StartCoroutine(
            api.UpdateItem(
                item,
                updatedItem =>
                {
                    Debug.Log(
                        $"Updated: {updatedItem.name}"
                    );

                    LoadItems();
                }
            )
        );
    }


    public void DeleteItem()
    {
        int id =
            int.Parse(idInput.text);

        StartCoroutine(
            api.DeleteItem(
                id,
                success =>
                {
                    if (success)
                    {
                        Debug.Log(
                            $"Deleted item {id}"
                        );

                        LoadItems();
                    }
                }
            )
        );
    }
}