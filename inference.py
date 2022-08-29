import sys
import matplotlib.pyplot as plt
import pandas as pd
import numpy as np
from nltk.tokenize import word_tokenize
from nltk import pos_tag
from nltk.corpus import stopwords
from nltk.stem import WordNetLemmatizer
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import accuracy_score
from sklearn.preprocessing import LabelEncoder
from collections import defaultdict
from nltk.corpus import wordnet as wn
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn import model_selection, naive_bayes, svm
import pickle
import ast
import js2py
from nltk.tokenize import sent_tokenize


f = open("comments.txt", "r",encoding="utf8")
stri = f.read()
l = sent_tokenize(stri)
# sent=""
# l=[]
# for st in range(1,len(stri)):
#     if stri[st] != ".":
#         sent= sent + stri[st]
#     else:
#         l.append(sent)
#         sent=""
#print(l)  

# WordNetLemmatizer requires Pos tags to understand if the word is noun or verb or adjective etc. By default it is set to Noun
tag_map = defaultdict(lambda: wn.NOUN)
tag_map['J'] = wn.ADJ
tag_map['V'] = wn.VERB
tag_map['R'] = wn.ADV


def text_preprocessing(text):
    # Step - 1b : Change all the text to lower case. This is required as python interprets 'dog' and 'DOG' differently
    text = text.lower()

    # Step - 1c : Tokenization : In this each entry in the corpus will be broken into set of words
    text_words_list = word_tokenize(text)

    # Step - 1d : Remove Stop words, Non-Numeric and perfom Word Stemming/Lemmenting.
    # Declaring Empty List to store the words that follow the rules for this step
    Final_words = []
    # Initializing WordNetLemmatizer()
    word_Lemmatized = WordNetLemmatizer()
    # pos_tag function below will provide the 'tag' i.e if the word is Noun(N) or Verb(V) or something else.
    for word, tag in pos_tag(text_words_list):
        # Below condition is to check for Stop words and consider only alphabets
        if word not in stopwords.words('english') and word.isalpha():
            word_Final = word_Lemmatized.lemmatize(word, tag_map[tag[0]])
            Final_words.append(word_Final)
        # The final processed set of words for each iteration will be stored in 'text_final'
    #Final_words = str(Final_words)
    #print(Final_words)
    return str(Final_words)


# Loading Label encoder
labelencode = pickle.load(open('labelencoder_fitted.pkl', 'rb'))

# Loading TF-IDF Vectorizer
Tfidf_vect = pickle.load(open('Tfidf_vect_fitted.pkl', 'rb'))

# Loading models
SVM = pickle.load(open('svm_trained_model.sav', 'rb'))
Naive = pickle.load(open('nb_trained_model.sav', 'rb'))
pos=[]
neg=[]
send=[]
#r=['nice one','another post pls ignore']
# Text from social media app --->
sample_text_i = l
for sample_text in sample_text_i:
    sample_text_processed = text_preprocessing(sample_text)
    sample_text_processed_vectorized = Tfidf_vect.transform([sample_text_processed])
    

    Encoder = LabelEncoder()

    #Prediction --->

    prediction_SVM = SVM.predict(sample_text_processed_vectorized)
    prediction_Naive = Naive.predict(sample_text_processed_vectorized)

    #print("Prediction from SVM Model:", labelencode.inverse_transform(prediction_SVM)[0])

    #print("Prediction from NB Model:", labelencode.inverse_transform(prediction_Naive)[0])
    if labelencode.inverse_transform(prediction_SVM)[0] == '__label__1':
        pos.append(1)
    else:
        neg.append(0)
send.append(pos)
send.append(neg)
print(send)


# code_2 = "function f(x) {return x+x;}"
# res_2 = js2py.eval_js(code_2)
  
# print(res_2(5))        
#print(pos)
#print(neg)
# posi=0
# negi=0
# #x-coordinates of left sides of bars
# left = ['positve','negative']
# var1 = len(pos)
# var2 = len(neg)
# var3 = len(pos)+len(neg)
# #print(var1,var2,var3)
# if var1 == 0:
#     posi=0
# if var2==0:
#     negi=0
# if var3==0:
#     posi=0
#     negi=0        
    

# posi = (var1/var3)*100 
# negi = (var2/var3)*100
# # heights of bars
# height = [posi,negi]
# #print(height)
 
# # labels for bars
# tick_label = ['positive','negative']
 
# # plotting a bar chart
# plt.bar(left, height, tick_label = tick_label,
#         width = 0.1, color = ['red', 'green'])
 
# # naming the x-axis
# plt.xlabel('x - axis')
# # naming the y-axis
# plt.ylabel('y - axis')
# # plot title
# plt.title('My bar chart!')

# plt.savefig('graph.jpg')
# # function to show the plot
# #plt.show()
     
        