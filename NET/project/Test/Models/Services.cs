using System.ComponentModel.DataAnnotations;
using Test.Models;

namespace test.Models {

    public class Services {

        public int Id { get; set; }

        //Get Customer list
        [Required(ErrorMessage = "Cannot be empty")]
        public string? Service {get; set; }

        
        //Get Customer list
        [Required(ErrorMessage = "Cannot be empty")]
        public int? Price {get; set; }
    }

}