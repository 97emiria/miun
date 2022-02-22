using System.ComponentModel.DataAnnotations;

namespace musicbank.Models
{
    public class Artists
    {
        //Properies
        public int id { get; set; }
        
        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Name { get; set; }

    }
}
