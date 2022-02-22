using System.ComponentModel.DataAnnotations;

namespace musicBank.Models
{
    public class Artists
    {
        //Properies
        public int id { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Name { get; set; }

        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Country { get; set; }

        public ICollection<Relation>? Relation { get; set; }
    }
}
