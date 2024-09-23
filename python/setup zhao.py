from setuptools import setup, find_packages

setup(
    name="Cheminformaticsedu",  # 替换为你的包名
    version="1.0.3",  # 版本号
    author="Ziheng Zhao",
    author_email="zhacisbw4801@gmail.com",
    description="chemie education cooperate with ai",
    long_description=open('README.md').read(),  # 如果有 README 文件
    long_description_content_type="text/markdown",  # 如果 README 文件是 markdown 格式
    url="https://github.com/Yakimochinai/che-edu",  # 项目主页
    packages=find_packages(),  # 自动找到项目中的所有包
    classifiers=[
        "Programming Language :: Python :: 3",
        "License :: OSI Approved :: MIT License",
        "Operating System :: OS Independent",
    ],
    python_requires='>=3.6',  # Python 版本要求
)
