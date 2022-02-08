using System.ComponentModel.DataAnnotations;

namespace momentet.Models {

    public class CourseModel {

        //Properties
        [Display(Name = "Kurskod:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        [MaxLength(6, ErrorMessage = "En kurskod innehåller max 6 tecken")]
        public string? Code { get; set; }

        [Display(Name = "Kursnamn:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Name { get; set; }

        [Display(Name = "Progression:")]
        [Required(ErrorMessage = "Välj ett alternativ")]
        public string? Progression { get; set; }

        [Display(Name = "Kurslänk:")]
        [Required(ErrorMessage = "Kan inte va tomt")]
        public string? Url { get; set; }

    }



}