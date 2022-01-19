using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.IO;
using System.Text.Json;


namespace Project
{
    internal class fileHandler
    {
        protected string path = "sleepData.json";

        //Get counted saved data  
        public int getCurrentDaySaved()
        {
            List<string> sleepingDataList = getData();
            return sleepingDataList.Count;
        }

        public void fileExist()
        {

            try
            {
                //Create an instance of StreamReader to read from a file.
                using (StreamReader sr = new StreamReader(path));
            }
            catch (Exception)
            {
                using (FileStream fs = File.Create(path));
            }
        }

        public List<string> getData()
        {
            
            List<string> sleepList = new List<string>();
            string lines;
            
            using StreamReader sr = new StreamReader(path);
            
            {
                while ((lines = sr.ReadLine()) != null)
                {
                    sleepList.Add(lines);
                }

            }
            return sleepList;
        }


        public void update(List<string> data)
        {
            creatFile();

            //Save it as Json
            for (int i = 0; i < data.Count; i++)
            {
                File.AppendAllText(path, data[i] + Environment.NewLine);
            }

        }


        public void add(string jsonString)
        {
            File.AppendAllText(path, jsonString + Environment.NewLine);

            //Check so list is not more then 90 days/logs
            List<string> dataList = getData();
            dataList.Reverse();
            creatFile();
            for (int i = 0; i < dataList.Count && i < 90; i++)
            {
                File.AppendAllText(path, dataList[i] + Environment.NewLine);
            }

            //Reverse it right again?
            List<string> dataListTwo = getData();
            dataListTwo.Reverse();
            creatFile();
            for (int i = 0; i < dataList.Count && i < 90; i++)
            {
                File.AppendAllText(path, dataListTwo[i] + Environment.NewLine);
            }

        }

        public void creatFile()
        {
            using (FileStream fs = File.Create(path));
        }


    }
}
