import requests

class S88:
    def __init__(self):
        self.ghAPI = ""
        # Your GitHub Personal Access Token
        self.token = ""
        self.headers = {'Authorization': f'token {self.token}'}
              
    def loadFromGithub(self, repo, path=''):
        """
        Recursively fetch and concatenate content of all XML files, excluding
        those with 'test' in their names, from a GitHub repository.

        :param repo: Repository name with owner (e.g., 'owner/repo')
        :param path: Path to start listing files from (default is root)
        :return: Concatenated content of all XML files
        """
        content_accumulator = []  # Initialize an empty list to accumulate XML contents
        api_url = f'https://api.github.com/repos/{repo}/contents/{path}'
        response = requests.get(api_url, self.headers)
        if response.status_code == 200:
            contents = response.json()
            for content in contents:
                # Skip files with 'test' in their name
                if 'test' in content['name'].lower():
                    continue
                if content['type'] == 'file' and content['name'].endswith('.xml'):
                    file_response = requests.get(content['download_url'], self.headers)
                    if file_response.status_code == 200:
                        content_accumulator.append(file_response.text)  # Add file content to the accumulator
                elif content['type'] == 'dir':
                    # Recursive call to navigate into subdirectories
                    dir_content = self.loadFromGithub(repo, content['path'])
                    content_accumulator.append(dir_content)
        return '\n'.join(content_accumulator)  # Join all contents with a newline separator

    def loadFromFile(version: str):
        """
        """
        return "not implemented"

    def saveToFile(version: str):
        """
        """
        return "not implemented"
    
    def listGithub(self, repo, path=''):
        """
        Recursively list all XML files in a GitHub repository.

        :param repo: Repository name with owner (e.g., 'owner/repo')
        :param path: Path to start listing files from (default is root)
        """
        api_url = f'https://api.github.com/repos/{repo}/contents/{path}'
        response = requests.get(api_url, self.headers)
        if response.status_code == 200:
            contents = response.json()
            for content in contents:
                if content['type'] == 'file' and content['name'].endswith('.xml'):
                    print(content['download_url'])  # Print the URL to download the XML file
                elif content['type'] == 'dir':
                    # Recursive call to navigate into subdirectories
                    list_files_recursive(repo, content['path'])

