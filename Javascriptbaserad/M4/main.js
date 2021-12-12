  //Users input
  let year = "1997";

  //Get the input
  let y = year.substring(0, 1);
  let e = year.substring(1, 2);
  let a = year.substring(2, 3);
  let r = year.substring(4, 3);

  //Arrays
  let thousend = ["M", "MM"];
  let hundred = [" ", "C", "CC", "CCC", "CD", "D", "DC", "DCC", "DCCC", "CM"]
  let ten = [" ", "X", "XX", "XXX", "XL", "L", "LX", "LXX", "LXXX", "XC", "C"]
  let one = [" ", "I", "II", "III", "IV", "V", "VI", "VII", "VIII", "IX", "X"]

  //Test
  console.log(thousend[y-1],  hundred[e],  ten[a],  one[r]);




